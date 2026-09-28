<?php
// Start output buffering to prevent "headers already sent" errors across all redirects
if (!ob_get_level()) {
    ob_start();
}

// Load .env file if present
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if (!isset($_SERVER[$key]) && !isset($_ENV[$key])) {
                putenv("$key=$val");
                $_ENV[$key] = $val;
                $_SERVER[$key] = $val;
            }
        }
    }
}

// Determine DB configuration from environment or fallback to defaults
$db_host = getenv('DB_HOST') ?: (getenv('MYSQL_HOST') ?: 'localhost');
$db_user = getenv('DB_USER') ?: (getenv('MYSQL_USER') ?: 'root');
$db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : (getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '');
$db_name = getenv('DB_NAME') ?: (getenv('MYSQL_DATABASE') ?: 'sss');
$db_port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

// Establish database connection (supports both standard and SSL connections for cloud databases)
$conn = mysqli_init();
if (getenv('DB_SSL') === 'true' || getenv('MYSQL_SSL') === 'true' || $db_port == 4000) {
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
    $connected = @mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL);
} else {
    $connected = @mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port);
}

if (!$connected) {
    die("Unable to Connect database: " . mysqli_connect_error() . "<br>Please check database credentials or import database.sql.");
}

// Set charset to utf8mb4
mysqli_set_charset($conn, "utf8mb4");

// Alias $con for backward compatibility across legacy controllers
$con = $conn;
?>