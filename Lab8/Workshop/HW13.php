<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "<div style='margin-bottom:20px;'>";
        echo "<img src='product_photo/" . $row["pid"] . ".jpg' width='100' height='100'><br>";
        echo "รหัสสินค้า : " . $row ["pid"] . "<br>";
        echo "ชื่อสินค้า : " . $row ["pname"] . "<br>";
        echo "รายละเอียดสินค้า : " . $row ["pdetail"] . "<br>";
        echo "ราคา: " . $row ["price"] . " บาท <br>";
        echo "<a href='editform_product_13.php?pid=" . $row ["pid"] . "'>แก้ไข</a>";
        echo "<hr>";
        echo "</div>";
    }
?>
</body>
</html>