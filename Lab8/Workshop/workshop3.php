<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <div style="display:block">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member");
        $stmt->execute();
        ?>

        <?php while ($row = $stmt->fetch()) : ?>
            <div style="padding: 10px; padding-top: 0px; padding-bottom: 0px; text-align: left">
                ชื่อสมาชิก : <?= $row["name"] ?><br>
                ที่อยู่ : <?= $row["address"] ?><br>
                อีเมล : <?= $row["email"] ?><br>

                <?php
                $path = "member_photo/" . $row["username"] . ".jpg";
                ?>
                <img src="<?= $path ?>" width="100"><br>
                <hr>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>