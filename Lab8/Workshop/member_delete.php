<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(pid) { // ฟังก์ชันจะถูกเรียกถ้าผู้ใช้คลิกที่่ link ลบ
            var ans = confirm("ต้องการลบสินค้ารหัส " + pid); // แสดงกล่องถามผู้ใช ้
            if (ans == true) // ถ้าผู้ใชกด ้ OK จะเข ้าเงื่อนไขนี้
                document.location = "delete.php?pid=" + pid; // ส่งรหัสสินค้าไปให้ไฟล์ delete.php
        }
    </script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "รหัสสินค้า : " . $row["pid"] . "<br>";
        echo "ชื่อสินค้า : " . $row["pname"] . "<br>";
        echo "รายละเอียดสินค้า : " . $row["pdetail"] . "<br>";
        echo "ราคา: " . $row["price"] . " บาท <br>";
        echo "<a href='editform.php?pid=" . $row["pid"] . "'>แก ้ไข</a> | ";
        echo "<a href='#' onclick='confirmDelete(" . $row["pid"] . ")'>ลบ</a>";
        echo "<hr>\n";
    }
    ?>
</body>

</html>