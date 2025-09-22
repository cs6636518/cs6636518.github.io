<?php include "connect.php"; ?>

<?php
    $stmt = $pdo->prepare("INSERT INTO product VALUES (null, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["pname"]);
    $stmt->bindParam(2, $_POST["pdetail"]);
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->execute();

    // ดึง pid ล่าสุดมาใช้ตั้งชื่อไฟล์รูป
    $pid = $pdo->lastInsertId();

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $uploadDir = "product_photo/";

        // ถ้าโฟลเดอร์ยังไม่มี ให้สร้าง
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // ตั้งชื่อไฟล์รูป = pid.jpg
        $uploadFile = $uploadDir . $pid . ".jpg";

        // ย้ายไฟล์จาก temp ไปเก็บในโฟลเดอร์
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            // success
        } else {
            echo "อัพโหลดรูปไม่สำเร็จ";
        }
    }

    // กลับไปหน้าแสดงรายการสินค้า
    header("location: show_productlist_10.php");
    exit();
?>
