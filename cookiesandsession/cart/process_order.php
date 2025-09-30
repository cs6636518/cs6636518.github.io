<?php
    session_start();
    include "connect.php";

    $stmt = $pdo -> prepare("insert into orders (username, status)
    values (?, 'wait');");
    $stmt -> bindParam(1, $_SESSION['username']);
    $stmt -> execute();

    $ord_id = $pdo->lastInsertId();

    $stmtItem = $pdo->prepare("INSERT INTO item (ord_id, pid, quantity) VALUES (?, ?, ?)");
    $stmtStock = $pdo->prepare("UPDATE product SET stock = stock - ? WHERE pid = ?");
    foreach ($_SESSION['cart'] as $item) {
        $stmtItem->execute([$ord_id, $item['pid'], $item['qty']]);
        $stmtStock->execute([$item['qty'], $item['pid']]);
    }
    unset($_SESSION['cart']);
    header("Location: ../myShop/customer_page.php");
?>