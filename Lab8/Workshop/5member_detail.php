<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // 1. กำหนดคำสั่ง SQL ให้ดึงสนค้าตามรหัสสินค้า

    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
    $stmt->bindParam(1, $_GET["username"]); // 2. นำค่า pid ที่ส่งมากับ URL กำหนดเป็นเงื่อนไข
    $stmt->execute(); // 3. เริ่มค้นหา
    $row = $stmt->fetch(); // 4. ดึงผลลัพธ์ (เนื่องจากมีข้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
    ?>

    <div style="display:flex">
        <div>
            <img src='member_photo/<?= $row["username"] ?>.jpg' width='200'>
        </div>
        <div style="padding: 15px">
            <h2><?= $row["username"] ?></h2>
            ชื่อ : <?= $row["name"] ?><br>
            ที่อยู่ : <?= $row["address"] ?><br><br>
            อีเมล : <?= $row["email"] ?>
        </div>
    </div>
</body>

</html>