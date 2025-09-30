<?php
try {
    $pdo = new PDO("mysql:host=localhost;
                         dbname=168DB_59;
                         charset=utf8","168DB59","iprPhuxf");
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>