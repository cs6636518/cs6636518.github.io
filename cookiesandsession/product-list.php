<?php
	include "connect.php";
    session_start();
    // ตรวจสอบว่ามีชื่อใน cookiesandsession หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if (empty($_SESSION["username"]) ) { 
        header("location: index.php");
    }
?>

<html>
<head><meta charset="utf-8"></head>
<body>
<?php
   $stmt = $pdo->prepare("SELECT * FROM product");
   $stmt->execute();

   while ($row = $stmt->fetch()) {
       echo "ชื่อสินค้า: " . $row ["pname"] . "<br>";
       echo "ราคา: " . $row ["price"] . " บาท <br>";
       echo "<hr>\n";
   }
?>
</body>
</html>
