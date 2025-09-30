<html>

<body>
    <?php
    // ถ้าคุกกี้ visit เป็นค่าว่าง ให ้สร้างคุกกี้ visit และกำหนดค่าเริ่มต้นเป็น 0
    if (empty($_COOKIE["visit"])) {
        setcookie("visit", 0, time() + 3600 * 24);
    }
    // ตรวจสอบว่าคุกกี้ชอvisit ถูกกำหนดค่าไว้แล้วหรือไม่

    // ถ้ายังไม่กำหนด
    if (!isset($_COOKIE["visit"])) {
        echo "Welcome to my website! Click here for a tour";
        // ถำากำหนดค่าแล้ว จะเพิ่มค่าขึ้น 1 ค่า
    } else {
        $visit = $_COOKIE["visit"] + 1;
        setcookie("visit", $visit, time() + 3600 * 24);
        echo "This is visit number $visit.";
    }
    ?>
</body>

</html>