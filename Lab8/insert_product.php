<?php include "connect.php" ?>

<?php
$stmt = $pdo->prepare("INSERT INTO product VALUES (null, ?, ?, ?)");
$stmt->bindParam(1, $_POST["pname"]);
$stmt->bindParam(2, $_POST["pdetail"]);
$stmt->bindParam(3, $_POST["price"]);
$stmt->execute(); // เริ่มเพิ่มข้อมูล
$pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มสำเร็จ
?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    เพิ่มสินค้าสำเร็จ รหัสสินค้าใหม่ คือ <?= $pid ?>
</body>

</html>