<?php

session_start();
include "connect.php";

$stmt = $pdo->prepare("SELECT stock FROM product WHERE pid = ?");

// เพิ่มสินค้า
if ($_GET["action"] == "add") {

    $pid = $_GET['pid'];
    $stmt->bindParam(1, $pid);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row['stock'] >= $_SESSION['cart'][$pid]['qty'] + $_POST['qty']) {
        $cart_item = array(
            'pid' => $pid,
            'pname' => $_GET['pname'],
            'price' => $_GET['price'],
            'qty' => $_POST['qty']
        );

        // ถ้ายังไม่มีสินค้าใดๆในรถเข็น
        if (empty($_SESSION['cart']))
            $_SESSION['cart'] = array();

        // ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
        if (array_key_exists($pid, $_SESSION['cart']))
            $_SESSION['cart'][$pid]['qty'] += $_POST['qty'];

        // หากยังไม่เคยเลือกสินค้นนั้นจะ
        else
            $_SESSION['cart'][$pid] = $cart_item;
    } else {
        echo "จำนวนสินค้าคงเหลือในคลังน้อยกว่าที่ท่านเลือก (" . $row['stock'] . ")";
    }



    // ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"] == "update") {
    $pid = $_GET["pid"];
    $qty = intval($_GET["qty"]);

    // ดึง stock ล่าสุดจากฐานข้อมูล
    $stmt->bindParam(1, $pid);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($qty <= $row['stock']) {
        $_SESSION['cart'][$pid]['qty'] = $qty;
    } else {
        $_SESSION['cart'][$pid]['qty'] = $row['stock']; // ปรับเป็น stock สูงสุด
        echo "จำนวนสินค้าคงเหลือในคลังน้อยกว่าที่ท่านเลือก (" . $row['stock'] . ")";
    }
} else if ($_GET["action"] == "delete") {

    $pid = $_GET['pid'];
    unset($_SESSION['cart'][$pid]);
}
?>

<html>

<head>
    <script>
        // ใช้สำหรับปรับปรุงจำนวนสินค้า
        function update(pid) {
            var qty = document.getElementById(pid).value;
            // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
            document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty;
        }
    </script>
</head>

<body>
    <h1>Hi, <?= $_SESSION["username"] ?>!</h1>
    <form action="process_order.php" method="GET">
        <table border="1">
            <?php
            $sum = 0;
            foreach ($_SESSION["cart"] as $item) {
                $sum += $item["price"] * $item["qty"];
            ?>
                <tr>
                    <td><?= $item["pname"] ?></td>
                    <td><?= $item["price"] ?></td>
                    <td>
                        <input type="number" id="<?= $item["pid"] ?>" value="<?= $item["qty"] ?>" min="1" max="9">
                        <a href="#" onclick="update(<?= $item["pid"] ?>)">แก้ไข</a>
                        <a href="?action=delete&pid=<?= $item["pid"] ?>">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right">รวม <?= $sum ?> บาท</td>
            </tr>
        </table>
        <button type="submit">ยืนยันการสั่งสินค้า</button>
    </form>

    <a href="index.php">
        < เลือกสินค้าต่อ</a>
</body>

</html>