<?php
declare(strict_types=1);

header('Content-Type: application/json');

// DB connection
require_once __DIR__ . '/../config/db.php';

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

// --- Security: Only allow POST requests ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// --- Collect form input ---
$first_name   = trim($_POST['first_name'] ?? '');
$last_name    = trim($_POST['last_name'] ?? '');
$email        = trim($_POST['email'] ?? '');
$phone        = trim($_POST['phone'] ?? '');
$gender       = trim($_POST['gender'] ?? '');
$designation  = trim($_POST['designation'] ?? '');
$status       = 1; // default active

// --- Validation ---
if (empty($first_name) || empty($last_name) || empty($email) || empty($designation)) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

// --- Assign default avatar based on gender ---
$picture = null;
if (strtolower($gender) === 'male') {
    $picture = 'assets/media/male-avatar.png';
} elseif (strtolower($gender) === 'female') {
    $picture = 'assets/media/female-avatar.png';
} else {
    $picture = 'assets/media/default-avatar.png';
}

// --- Generate a temporary password ---
$temp_password = bin2hex(random_bytes(4)); // 8-character random
$hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

try {
    // --- Insert user into database ---
    $stmt = $pdo->prepare("
        INSERT INTO users (
            first_name, last_name, email, phone, gender, designation, password, status, picture, date_created
        ) VALUES (
            :first_name, :last_name, :email, :phone, :gender, :designation, :password, :status, :picture, NOW()
        )
    ");

    $stmt->execute([
        'first_name'   => $first_name,
        'last_name'    => $last_name,
        'email'        => $email,
        'phone'        => $phone,
        'gender'       => $gender,
        'designation'  => $designation,
        'password'     => $hashed_password,
        'status'       => $status,
        'picture'      => $picture
    ]);

    // --- Send credentials via PHPMailer SMTP ---
    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host       = 'mail.thevineyard.ng'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'noreply@thevineyard.ng';
        $mail->Password   = 'Q)[l0b(_&q},_17r'; // ❌ Store in env variable in production
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // better for port 465
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('noreply@thevineyard.ng', 'Vineyard Intranet™');
        $mail->addAddress($email, $first_name . ' ' . $last_name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Welcome to the Intranet Portal";
        $mail->Body    = "
            Hi {$first_name},<br><br>
            Your intranet account has been created.<br>
            <strong>Email:</strong> {$email} <br>
            <strong>Temporary Password:</strong> {$temp_password} <br><br>
            Please login and change your password immediately.<br><br>
            Regards,<br>
            Admin Team
        ";

        $mail->send();

        echo json_encode([
            'success' => true,
            'message' => "User added successfully. Login details sent to {$email}"
        ]);
        exit;

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => "User created, but email could not be sent. Mailer Error: {$mail->ErrorInfo}"
        ]);
        exit;
    }

} catch (PDOException $e) {
    error_log("Add user error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit;
}