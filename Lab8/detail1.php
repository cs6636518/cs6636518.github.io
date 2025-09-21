<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // 1. กำหนดคำสั่ง SQL ให้ดึงสนค้าตามรหัสสินค้า

    $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
    $stmt->bindParam(1, $_GET["pid"]); // 2. นำค่า pid ที่ส่งมากับ URL กำหนดเป็นเงื่อนไข
    $stmt->execute(); // 3. เริ่มค้นหา
    $row = $stmt->fetch(); // 4. ดึงผลลัพธ์ (เนื่องจากมีข้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
    ?>

    <div style="display:flex">
        <div>
            <img src='product_photo/<?= $row["pid"] ?>.jpg' width='200'>
        </div>
        <div style="padding: 15px">
            <h2><?= $row["pname"] ?></h2>
            รายละเอียดสินค้า : <?= $row["pdetail"] ?><br>
            ราคาขาย <?= $row["price"] ?> บาท<br><br>
            ซื้อวันนี้ลด 10% เหลือ <?= $row["price"] * 0.9 ?> บาท
        </div>
    </div>
</body>

</html>