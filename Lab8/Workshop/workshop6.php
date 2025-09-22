<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(username) { // ฟังก์ชันจะถูกเรียกถ้าผู้ใช้คลิกที่่ link ลบ
            var ans = confirm("ต้องการลบusername " + username); // แสดงกล่องถามผู้ใช ้
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "delete_member_6.php?username=" + username; // ส่งรหัสสินค้าไปให้ไฟล์ delete.php
        }
    </script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ชื่อ : " . $row["name"] . "<br>";
        echo "ที่อยู่ : " . $row["address"] . "<br>";
        echo "อีเมล : " . $row["email"] . "<br>";
        echo "<a href='editform.php?pid=" . $row["username"] . "'>แก้ไข</a> | ";
        echo "<a href='#' onclick='confirmDelete(\"" . $row["username"] . "\")'>ลบ</a>";
        echo "<hr>\n";
    }
    ?>
</body>

</html>