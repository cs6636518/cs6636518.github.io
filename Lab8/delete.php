<?php include "connect.php" ?>
<?php
// เตรียมคำสั่ง SQL สำหรับลบข้อมูล

$stmt = $pdo->prepare("DELETE FROM product WHERE pid=?");
$stmt->bindParam(1, $_GET["pid"]); // กำหนดค่าลงในตำแหน่ง ?
if ($stmt->execute()) // เริ่มลบข้อมูล
    header("location: product_delete.php"); // กลับไปแสดงผลหน้าข้อมูล

?>