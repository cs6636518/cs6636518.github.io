<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <form>
        <input type="text" name="keyword">
        <input type="submit" value="ค้นหา">
    </form>

    <div style="display:block">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
        if (!empty($_GET)) // ถ้ามีค่าที่ส่งมาจากฟอร์ม
            $value = '%' . $_GET["keyword"] . '%'; // ดึงค่าที่ส่งมากำหนดให้กับตัวแปรเงื่อนไข
        $stmt->bindParam(1, $value); // กำหนดชื่อตัวแปรเงื่อนไขที่จุดที่กำหนดไว ้
        $stmt->execute(); // เริ่มค้นหา
        ?>

        <?php while ($row = $stmt->fetch()) : ?>
            <div style="padding: 15px; text-align: left">
                ชื่อสมาชิก : <?= $row["name"] ?><br>
                ที่อยู่ : <?= $row["address"] ?><br>
                อีเมล์ : <?= $row["email"] ?><br>
                <img src='member_photo/<?= $row["username"] ?>.jpg' width='100'><br>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>