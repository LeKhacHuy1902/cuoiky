<?php
session_start();
require_once __DIR__ . '/../models/BookingModel.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["booking_id"])) {
    $bookingModel = new BookingModel();
    $bookingId = $_POST["booking_id"];
    $userId = $_SESSION["user"]["id"];
    $bookingModel->cancelBooking($bookingId, $userId);
}

header("Location: dich-vu-da-dat.php");
exit;
