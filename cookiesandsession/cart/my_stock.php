<?php include "../connect.php"?>

<?php
session_start();
$stmt = $pdo -> prepare("select * from product;");
$stmt -> execute();
?>

<html>
<body>
<h1>Hi, <?=$_SESSION["username"]?>!</h1>
<h3>ยินดีต้อนรับสู่หน้า Admin</h3>
<table border="1">
    <tr>
        <th>สินค้า</th>
        <th>ราคา</th>
        <th>คงเหลือ</th>
    </tr>
    <?php
    while ($row = $stmt -> fetch()) {
        ?>
        <tr>
            <td><?=$row['pname']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['stock']?></td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="../myShop/admin_page.php">ย้อนกลับไปหน้าแอดมิน</a>
<p>หากต้องการออกจากระบบโปรดคลิก <a href='../logout.php'>ออกจากระบบ</a></p>
</body>
</html>
