<html>
<?php
// ตรวจสอบว่ามีการส่งค่า 'language' ผ่าน URL หรือไม่
if (isset($_GET['language'])) {
    // รับค่าจาก URL
    $language = $_GET['language'];

    // ตรวจสอบว่า language ที่ได้รับเป็น 'en' หรือ 'th'
    if ($language === 'en' || $language === 'th') {
        // ตั้งค่าคุกกี้ lang โดยมีอายุ 1 ชั่วโมง
        setcookie('lang', $language, time() + 3600, '/');
        echo "คุกกี้ 'lang' ถูกตั้งค่าเป็น: " . $language;
    } else {
        echo "ค่าของ 'language' ไม่ถูกต้อง";
    }
} else {
    echo "โปรดส่งค่า 'language' ผ่าน URL เช่น ?language=en หรือ ?language=th";
}
?>

</html>