<?php
include "connect.php";
include "order_detail.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
if (empty($_SESSION["username"])) {
    header("location: login-form.php");
} else {
    OrderUser($pdo, $_SESSION["username"]);
}
