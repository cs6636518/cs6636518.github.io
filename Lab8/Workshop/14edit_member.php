<?php include "connect.php" ?>

<?php
    $stmt = $pdo->prepare("UPDATE member SET password=?, name=?, address=?, mobile=?, email=? WHERE username=?");
    $stmt->bindParam(1, $_POST["password"]);
    $stmt->bindParam(2, $_POST["name"]);
    $stmt->bindParam(3, $_POST["address"]);
    $stmt->bindParam(4, $_POST["mobile"]);
    $stmt->bindParam(5, $_POST["email"]);
    $stmt->bindParam(6, $_POST["username"]);
    $stmt->execute();
    
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $uploadDir = "member_photo/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . $_POST["username"] . ".jpg";
         // ย้ายไฟล์ใหม่มาแทนของเดิม
         if(!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            echo "อัปโหลดรูปไม่สำเร็จ";
            exit();
         }
    }

    header("location: HW14.php");
    exit();
?>