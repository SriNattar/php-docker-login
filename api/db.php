<?php
// API wrapper DB connection for Vercel deployment
// Reads credentials from environment variables (set in Vercel dashboard)
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'php_login_db';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASS') ?: '';
$port = getenv('DB_PORT') ?: '5432';
$sslmode = getenv('DB_SSLMODE') ?: 'disable';

$dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode={$sslmode}";

try {
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('DB Connection failed: ' . $e->getMessage());
    http_response_code(500);
    echo 'Internal Server Error';
    exit;
}
?>
