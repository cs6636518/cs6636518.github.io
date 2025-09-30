<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=168DB_57;charset=utf8", "168DB57", "qhfUiQXU");
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด : " . $e->getMessage();
}
