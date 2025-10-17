<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Environment Detection
$env = (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) ? 'development' : 'production';

// Database Settings
if ($env === 'development') {
    $db_host = 'localhost';
    $db_name = 'vineyard_intranet';
    $db_user = 'root';
    $db_pass = '';
} else {
    $db_host = 'localhost';
    $db_name = 'thevine1_intranet';
    $db_user = 'thevine1_intranet';
    $db_pass = 'r8DxC2NsdyXXqz@';
}

// PDO Configuration
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.'
    ]);
    exit;
}
