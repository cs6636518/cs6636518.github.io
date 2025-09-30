<?php
include "connect.php";

session_start();

$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();

// หาก username และ password ตรงกัน
if (!empty($row)) {
  // เก็บข้อมูลลง session
  $_SESSION["fullname"] = $row["name"];
  $_SESSION["username"] = $row["username"];
  $_SESSION["role"] = $row["role"];

  // ถ้า role เป็น admin → ไปหน้า admin
  if ($row["role"] === "admin") {
    header("Location: w2_admin.php");
  } else {
    // ถ้าเป็น user ปกติ → ไปหน้า user
    header("Location: w1_user.php");
  }
  exit;

} else {
  echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง<br>";
  echo "<a href='login-form.php'>เข้าสู่ระบบอีกครั้ง</a>";
}
?>
