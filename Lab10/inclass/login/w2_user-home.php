<?php 
session_start(); 
include "connect.php";
?>

<html>
<body>
    <h1>สวัสดี <?= $_SESSION["fullname"] ?></h1>
    <a href='logout.php'>ออกจากระบบ</a>
    <hr>

    <?php
    if ($_SESSION["role"] == "admin") {
        echo "<h2>รายการสรุป Order ของผู้ใช้แต่ละคน</h2>";
        $stmt = $pdo->query("SELECT username, COUNT(*) as total_order 
                             FROM orders 
                             GROUP BY username");
        echo "<table border='1'>";
        echo "<tr><th>Username</th><th>จำนวน Order</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr><td>".$row["username"]."</td><td>".$row["total_order"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>รายการ Order ของคุณ</h2>";
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
        $stmt->bindParam(1, $_SESSION["username"]);
        $stmt->execute();

        echo "<table border='1'>";
        echo "<tr><th>OrderID</th><th>รายละเอียด</th><th>วันที่</th></tr>";
        while ($row = $stmt->fetch()) {
            echo "<tr><td>".$row["order_id"]."</td><td>".$row["detail"]."</td><td>".$row["order_date"]."</td></tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>
