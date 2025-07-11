<?php
require_once '../config/auth.php';
require_once '../models/BookingModel.php';

// Kiểm tra đăng nhập
requireLogin();

$bookingModel = new BookingModel();
$orders = $bookingModel->getUserBookings(currentUser()['id']);

include '../views/orders.php';
