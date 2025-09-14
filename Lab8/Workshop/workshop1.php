<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM product");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row["pid"] . "</td>";
                echo "<td>" . $row["pname"] . "</td>";
                echo "<td>" . $row["pdetail"] . "</td>";
                echo "<td>" . $row["price"] . " บาท</td>";
                echo "</tr>\n";
            }
            ?>
        </tbody>
    </table>
</body>

</html>