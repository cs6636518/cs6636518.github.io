<html>
<?php
// ตรวจสอบว่ามีคุกกี้ 'lang' อยู่หรือไม่
if (isset($_COOKIE['lang'])) {
    // อ่านค่าจากคุกกี้
    $lang = $_COOKIE['lang'];

    // ตรวจสอบค่าของคุกกี้ 'lang' และแสดงข้อความที่เหมาะสม
    if ($lang === 'en') {
        echo "Welcome";  // ถ้าคุกกี้ lang มีค่าเป็น 'en'
    } elseif ($lang === 'th') {
        echo "ยินดีต้อนรับ";  // ถ้าคุกกี้ lang มีค่าเป็น 'th'
    } else {
        echo "ค่าของคุกกี้ 'lang' ไม่ถูกต้อง";
    }
} else {
    echo "คุกกี้ 'lang' ไม่พบ";
}
?>

</html>