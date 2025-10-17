<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// --- IP & Rate Limiting Config ---
$ip           = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$userAgent    = $_SERVER['HTTP_USER_AGENT'] ?? null;
$maxAttempts  = 5;
$lockoutMins  = 15;

// --- Check Failed Login Attempts ---
$checkStmt = $pdo->prepare("
    SELECT COUNT(*) FROM login_attempts
    WHERE ip_address = :ip 
      AND attempt_time > (NOW() - INTERVAL $lockoutMins MINUTE)
");
$checkStmt->execute(['ip' => $ip]);
$attempts = (int)$checkStmt->fetchColumn();

if ($attempts >= $maxAttempts) {
    echo json_encode([
        'success' => false,
        'message' => "Too many login attempts. Please try again in $lockoutMins minutes."
    ]);
    exit;
}

// --- Input Validation ---
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

// --- Authenticate User ---
try {
    $stmt = $pdo->prepare("
        SELECT id, email, password, first_name, last_name, picture, designation, status
        FROM users
        WHERE email = :email
        LIMIT 1
    ");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Log attempt for non-existent accounts too (avoid user enumeration)
        $pdo->prepare("INSERT INTO login_attempts (ip_address, attempt_time) VALUES (:ip, NOW())")
            ->execute(['ip' => $ip]);

        echo json_encode(['success' => false, 'message' => 'Invalid login credentials.']);
        exit;
    }

    if ((int)$user['status'] !== 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Your account is inactive. Please contact the administrator.'
        ]);
        exit;
    }

    if (password_verify($password, $user['password'])) {
        // Secure the session
        session_regenerate_id(true);

        // Store user info in session
        $_SESSION['user_id']     = (int)$user['id'];
        $_SESSION['email']       = $user['email'];
        $_SESSION['first_name']  = $user['first_name'];
        $_SESSION['last_name']   = $user['last_name'];
        $_SESSION['name']        = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['designation'] = $user['designation'];
        $_SESSION['picture'] = $user['picture'];

        // Clear failed login attempts
        $pdo->prepare("DELETE FROM login_attempts WHERE ip_address = :ip")
            ->execute(['ip' => $ip]);

        // Update last_login timestamp
        $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id")
            ->execute(['id' => $user['id']]);

        // Record successful login
        $pdo->prepare("
            INSERT INTO successful_logins (user_id, ip_address, user_agent)
            VALUES (:user_id, :ip, :user_agent)
        ")->execute([
            'user_id'    => $user['id'],
            'ip'         => $ip,
            'user_agent' => $userAgent
        ]);

        echo json_encode([
            'success'     => true,
            'message'     => 'Login successful.',
            'redirect'    => 'dashboard',
            'user' => [
                'id'         => $user['id'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
                'email'      => $user['email'],
                'designation'=> $user['designation'],
                'picture'=> $user['picture']
            ]
        ]);
    } else {
        // Wrong password → log failed attempt
        $pdo->prepare("INSERT INTO login_attempts (ip_address, attempt_time) VALUES (:ip, NOW())")
            ->execute(['ip' => $ip]);

        echo json_encode(['success' => false, 'message' => 'Invalid login credentials.']);
    }

} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage()); // for debugging
    echo json_encode([
        'success' => false,
        'message' => 'A server error occurred. Please try again later.'
    ]);
}