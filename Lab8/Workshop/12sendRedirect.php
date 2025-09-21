<?php include "connect.php" ?>
<?php
    $stmt = $pdo->prepare("INSERT INTO member VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->bindParam(3, $_POST["name"]);
    $stmt->bindParam(4, $_POST["address"]);
    $stmt->bindParam(5, $_POST["mobile"]);
    $stmt->bindParam(6, $_POST["email"]);

    $stmt->execute(); // เริ่มเพิ่มข้อมูล
    $username = $_POST["username"];

    if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $uploadDir = "member_photo/";

        // ถ้าโฟลเดอร์ยังไม่มี ให้สร้าง
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . $username . ".jpg";

        if(!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            echo "อัปโหลดรูปไม่สำเร็จ";
            exit();
        }
    }

    // header คือฟังก์ชันที่จัดการส่งข้อมูลไปยังไฟล์ที่กำหนด (send redirect)
    // ในที่นี้ ให้เปิดเว็บหน้า detail_member.php พร้อมกับส่ง username แนบไปกับ URL
    header("location: detail_member.php?username=" . $username);
    exit();
?>