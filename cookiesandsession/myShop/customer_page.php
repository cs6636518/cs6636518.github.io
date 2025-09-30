<?php include "../connect.php"?>

<?php
    session_start();
    if ($_SESSION["username"] == 'somsak') header("Location: admin_page.php");
    $stmt = $pdo -> prepare("SELECT ord_id, ord_date, status FROM orders WHERE username = ?");
    $stmt -> bindParam(1, $_SESSION["username"]);
    $stmt -> execute();
?>

<html>
    <body>
        <h1>Hi, <?=$_SESSION["username"]?>!</h1>
        <h3>ยินดีต้อนรับสู่ร้าน MyShop</h3>
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
        <a href="../cart/">ไปที่หน้าตะกร้าสินค้า</a>
        <p>หากต้องการออกจากระบบโปรดคลิก <a href='../logout.php'>ออกจากระบบ</a></p>
    </body>
</html>
