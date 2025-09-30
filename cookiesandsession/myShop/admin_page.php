<?php include "../connect.php"?>

<?php
session_start();
$stmt = $pdo -> prepare("select o.username, count(o.ord_id) as total_order from orders o group by o.username;");
$stmt -> execute();
?>

<html>
<body>
<h1>Hi, <?=$_SESSION["username"]?>!</h1>
<h3>ยินดีต้อนรับสู่หน้า Admin</h3>
<table border="1">
    <tr>
        <th>Customer</th>
        <th>Total Order</th>
    </tr>
    <?php
    while ($row = $stmt -> fetch()) {
        ?>
        <tr>
            <td><a href="admin_order_detail.php?username=<?=$row["username"]?>"><?=$row["username"]?></a></td>
            <td><a href="admin_order_detail.php?username=<?=$row["username"]?>"><?=$row["total_order"]?></a></td>
        </tr>
        <?php
    }
    ?>
</table>
<p>ไปที่หน้าสินค้าคงเหลือ <a href="../cart/my_stock.php">คลิ๊กที่นี่</a></p>
<p>หากต้องการออกจากระบบโปรดคลิก <a href='../logout.php'>ออกจากระบบ</a></p>
</body>
</html>
