<?php
include "util.php";
session_start();
if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $customer = json_decode($data, true);
  array_push($_SESSION['customers'], $customer);
}