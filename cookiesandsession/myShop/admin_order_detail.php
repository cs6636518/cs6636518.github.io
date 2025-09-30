<?php include "../connect.php"?>

<?php
session_start();
$stmt = $pdo -> prepare("SELECT ord_id, ord_date, status FROM orders WHERE username = ?");
$stmt -> bindParam(1, $_GET["username"]);
$stmt -> execute();
?>

<html>
<body>
<h1>ออเดอร์ของ <?=$_GET["username"]?></h1>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Status</th>
    </tr>
    <?php
    while ($row = $stmt -> fetch()) {
        ?>
        <tr>
            <td><?=$row["ord_id"]?></td>
            <td><?=$row["ord_date"]?></td>
            <td><?=$row["status"]?></td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="admin_page.php">ย้อนกลับ คลิ๊กที่นี่</a>
<p>หากต้องการออกจากระบบโปรดคลิก <a href='../logout.php'>ออกจากระบบ</a></p>
</body>
</html>
