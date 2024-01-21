<?php
session_start();
if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $quickBooking = json_decode($data, true);
  array_push($_SESSION['bookings']['quickBookings'], $quickBooking);
  echo json_decode($quickBooking);
}
