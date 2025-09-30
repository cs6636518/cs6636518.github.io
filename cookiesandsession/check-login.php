<?php
  include "connect.php";
  
  session_start();

  $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
  $stmt->bindParam(1, $_POST["username"]);
  $stmt->bindParam(2, $_POST["password"]);
  $stmt->execute();
  $row = $stmt->fetch();

  // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
  if (!empty($row)) { 
    // นำข้อมูลผู้ใช้จากฐานข้อมูลเขียนลง cookiesandsession 2 ค่า
    $_SESSION["fullname"] = $row["name"];   
    $_SESSION["username"] = $row["username"];

    // แสดง link เพื่อไปยังหน้าต่อไปหลังจากตรวจสอบสำเร็จแล้ว
    if ($row["admin"] == 1) header("location: myShop/admin_page.php");
    else header("location: myShop/customer_page.php");

  // กรณี username และ password ไม่ตรงกัน
  } else {
    echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
    echo "<a href='index.php'>เข้าสู่ระบบอีกครัง</a>";
  }
?>
