<?php
    include "connect.php";
    include "OrderDetail.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
     // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if (empty($_SESSION["username"])) { 
        header("location: login-form.php");
    }
    else{ //admin 
        echo "<strong>"."หน้าแอดมิน ".$_SESSION["username"] ."</strong>". "<br>";
        if(isset($_GET["user"])){ //ตอนหน้ามี url ?user=username
             OrderUser($pdo,$_GET["user"]);
        }
        else{ //แสดง order ทั้งหมด
            $stmt = $pdo->prepare(
                "SELECT m.username, COUNT(o.ord_id) AS order_count
                FROM member m
                LEFT JOIN orders o ON m.username = o.username
                GROUP BY m.username"
            );
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo "ชื่อผู้ใช้: " . $row["username"] . "<br>";
                echo "<a href='W10_2-3-4admin.php?user=".$row["username"]."'>"; //ลิ้งคลิ้ก สร้าง url ?user=username เมื่อกด จะโชว์ออเดอ
                echo "จำนวนออเดอร์: " . $row["order_count"] . "</a><br><hr>\n";
            }
        }
    }
?>
<p>ไปที่หน้าสินค้าคงเหลือ <a href="../cart/my_stock.php">คลิ๊กที่นี่</a></p>