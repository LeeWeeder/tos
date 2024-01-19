<?php
session_start();
if (isset($_POST)) {
  $data = file_get_contents("php://input");
  $package = json_decode($data, true);
  array_push($_SESSION['tourPackages'], $package);
}