<?php 

declare(strict_types=1);

$host = '127.0.0.1';
$port = '5432';
$dbname = 'coachprov3';
$user = 'postgres';
$pass = '2004';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    
    $stmt = $pdo->query("SELECT version()");
    echo $stmt->fetchColumn();
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

?>