<?php include "connect.php" ?>

<?php
    $stmt = $pdo->prepare("UPDATE product SET pname=?, pdetail=?, price=? WHERE pid=?"); 
    $stmt->bindParam(1, $_POST["pname"]); 
    $stmt->bindParam(2, $_POST["pdetail"]);
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->bindParam(4, $_POST["pid"]);
    $stmt->execute();

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $uploadDir = "product_photo/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . $_POST["pid"] . ".jpg";
         // ย้ายไฟล์ใหม่มาแทนของเดิม
         if(!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            echo "อัปโหลดรูปไม่สำเร็จ";
            exit();
         }
    }

    header("location: HW13.php");
    exit();
?>