<?php
include 'data/customers-data.php';
include 'util.php';

session_start();
$tourPackagesFileName = 'data/tourPackages.json';
$tourPackages = file_get_contents($tourPackagesFileName);
if (!isset($_SESSION['tourPackages'])) {
  $_SESSION['tourPackages'] = json_decode($tourPackages, true);
}

if (!isset($_SESSION['customers'])) {
  $_SESSION['customers'] = $customersData;
  for ($i = 0; $i < sizeof($_SESSION['customers']); $i++) {
    if (!isset($_SESSION['customers'][$i]['fullName'])) {
      $customer = $_SESSION['customers'][$i];
      $firstName = $customer['firstName'];
      $middleInitial = $customer['middleInitial'];
      $lastName = $customer['lastName'];
      $_SESSION['customers'][$i]['fullName'] = setFullName($firstName, $middleInitial, $lastName);
    }
  }
}

if (!isset($_SESSION['bookings'])) {
  if (!isset($_SESSION['bookings']['quickBookings'])) {
    $_SESSION['bookings']['quickBookings'] = array();
  }
  if (!isset($_SESSION['bookings']['customBookings'])) {
    $_SESSION['bookings']['customBookings'] = array();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tour Operator System</title>
  <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- <link rel="stylesheet" href="css/bootstrap-utilities.css"> -->
  <link rel="stylesheet" href="css/global.css">


</head>

<body id="override">
  <header class="navbar-header border-bottom">
    <nav class="navbar navbar-expand-md">
      <div class="container-lg">
        <a class="navbar-brand" href="#">
          <img src="images/icon.png" alt="Tour operator system icon" width="30" class="d-inline-block align-text-top">
          Tour Operator System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" id="navbar">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Tour Operator System</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/bookings/bookings.php">Bookings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/packages/packages.php">Packages</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/customers/customers.php">Customers</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="card border-primary mt-4">
        <div class="card-header">
          <h5>Bookings</h5>
        </div>
        <div class="container-fluid">
          <div class="card-body row">
            <div class="col-12 col-md-6">
              <div class="card text-bg-primary m-2">
                <div class="card-title ps-3 pt-3">
                  Quick bookings
                </div>
                <div class="card-text p-3 h-100">
                  Manage and create quick bookings from ready-made packages.
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <span class="badge text-bg-info"><?php
                  echo sizeof($_SESSION['bookings']['quickBookings']);
                  ?> booking/s</span>
                  <a class="btn btn-secondary" href="pages/bookings/bookings.php">Go</a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card border-primary m-2">
                <div class="card-title ps-3 pt-3">
                  Custom bookings
                </div>
                <div class="card-text p-3 h-100">
                  Plan your own itinerary. Fully customize your tour. Manage custom bookings.
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <span class="badge text-bg-info"><?php
                  echo sizeof($_SESSION['bookings']['customBookings']);
                  ?> booking/s</span>
                  <a class="btn btn-primary" href="pages/bookings/bookings.php?active='custom'">Go</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-4">
        <div class="container-fluid">
          <div class="card-body row">
            <div class="col-12 col-md-6">
              <div class="card border-primary m-2">
                <div class="card-title ps-3 pt-3">
                  Packages
                </div>
                <div class="card-text p-3">
                  Manage and create tour packages for quick bookings of customers.
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <span class="badge text-bg-info"><?php
                  echo sizeof($_SESSION['tourPackages']);
                  ?> package/s</span>
                  <a class="btn btn-secondary" href="pages/packages/packages.php">Go</a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card border-primary m-2">
                <div class="card-title ps-3 pt-3">
                  Customers
                </div>
                <div class="card-text p-3">
                  Manage your customers and add new customers that avail tours.
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <span class="badge text-bg-info"><?php
                  echo sizeof($_SESSION['customers']);
                  ?> customer/s</span>
                  <a class="btn btn-secondary" href="pages/customers/customers.php">Go</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="js/bootstrap.bundle.js"></script>

</html>