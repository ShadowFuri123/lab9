<?php
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'test_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Заглушка для работы без реальной БД
    $pdo = new class {
        public function prepare($sql) {
            return new class {
                public function execute($params = []) { return true; }
                public function fetchAll() { return []; }
            };
        }
        public function query($sql) {
            return new class {
                public function fetchAll() { return []; }
            };
        }
    };
}
return $pdo;