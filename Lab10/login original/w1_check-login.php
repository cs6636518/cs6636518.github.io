<?php
include "connect.php";
session_start();

$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();

if (!empty($row)) {
    $_SESSION["fullname"] = $row["name"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"]; // เก็บสิทธิ์ไว้ใน session

    echo "เข้าสู่ระบบสำเร็จ<br>";
    echo "<a href='w2_user-home.php'>ไปยังหน้าหลักของผู้ใช้</a>";
} else {
    echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง<br>";
    echo "<a href='login-form.php'>เข้าสู่ระบบอีกครั้ง</a>";
}
