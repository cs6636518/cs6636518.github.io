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

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $uploadDir = "member_photo/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $username = $_POST["username"]; 
        $uploadFile = $uploadDir . $username . ".jpg";

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {

        }else {
            echo " อัพโหลดรูปไม่สำเร็จ";
        }
    }
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>

<html>
<head><meta charset="utf-8"></head>
<body>
    <h3>รายละเอียดสมาชิกใหม่</h3>
    <div style="display:flex">
        <div>
            <img src="member_photo/<?=$row["username"]?>.jpg" width="120" height="150">
        </div>
        <div style="padding:15px">
            <?= "ชื่อสมาชิก: " . $row["name"] ?><br>
            <?= "ที่อยู่: " . $row["address"] ?><br>
            <?= "อีเมล์: " . $row["email"] ?><br>
        </div>
    </div>
</body>
</html>

