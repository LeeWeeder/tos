<?php
session_start();
if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $customBookings = json_decode($data, true);
  array_push($_SESSION['bookings']['customBookings'], $customBookings);
  echo json_decode($customBookings);
}
