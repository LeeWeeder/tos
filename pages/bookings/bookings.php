<?php
include '../../util.php';
session_start();
$quickBookings = $_SESSION['bookings']['quickBookings'];
$quickBookingsSize = sizeOf($quickBookings);
$customBookings = $_SESSION['bookings']['customBookings'];
$customBookingsSize = sizeOf($customBookings);

$isCustom = isset($_GET['active']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookings | Tour Operator System</title>
  <link rel="shortcut icon" href="../../images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <style>
    .nav-link {
      cursor: pointer;
    }
  </style>
</head>

<body id="override">
  <header class="navbar-header border-bottom">
    <nav class="navbar navbar-expand-md">
      <div class="container-lg">
        <a class="navbar-brand" href="#">
          <img src="../../images/icon.png" alt="Tour operator system icon" width="30" class="d-inline-block align-text-top">
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
                <a class="nav-link" href="../../index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Bookings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../packages/packages.php">Packages</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../customers/customers.php">Customers</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../../index.php" class="text-decoration-none">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Bookings</li>
            </ol>
          </nav>
          <h4>Bookings</h4>
          <p class="text-secondary">Keep track of bookings. Create and manage.</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link <?php
                                    if (!$isCustom) {
                                      echo 'active" aria-current="true"';
                                    }
                                    ?>" role="button" id="quickBookingNavButton">Quick bookings<span class="badge text-bg-primary ms-2">
                    <?php
                    echo $quickBookingsSize;
                    ?>
                  </span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php
                                    if ($isCustom) {
                                      echo 'active" aria-current="true"';
                                    }
                                    ?>" role="button" id="customBookingNavButton">Custom bookings<span class="badge text-bg-secondary ms-2"><?php
                                                                                                                                            echo $customBookingsSize;
                                                                                                                                            ?></span></a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="table-responsive <?php
                                          if ($isCustom) {
                                            echo 'd-none';
                                          }
                                          ?>" id="quickBooking">
              <div class="row mb-2">
                <div class="col-12 col-md-auto ms-md-auto">
                  <a name="newBookingButton" id="newBookingButton" class="btn btn-primary w-100 w-md-auto" href="add-new-booking.php" role="button">Quick book</a>
                </div>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Package</th>
                    <th scope="col">Start date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php
                  for ($i = 0; $i < $quickBookingsSize; $i++) {
                    $quickBooking = $quickBookings[$i];
                    $package = $quickBooking['package'];
                    $num = substr($package, 7);
                    $package = 'Package ' . $num;
                    echo '<tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $package . '</td>
                    <td>' . setDate($quickBooking['startDate']) . '</td>
                    <td>' . $quickBooking['customer'] . '</td>
                    <td>Actions</td>
                  </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="table-responsive <?php
                                          if (!$isCustom) {
                                            echo 'd-none';
                                          } ?>" id="customBooking">
              <div class="row mb-2">
                <div class="col-12 col-md-auto ms-md-auto">
                  <a name="newBookingButton" id="newBookingButton" class="btn btn-primary w-100 w-md-auto" href="custom-booking.php" role="button">Custom book</a>
                </div>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Number or members</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php
                  for ($i = 0; $i < $customBookingsSize; $i++) {
                    $customBooking = $customBookings[$i];
                    echo '<tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . ucwords($customBooking['destination']) . '</td>
                    <td>' . setDate($customBooking['duration']['start']) . ' to ' . setDate($customBooking['duration']['end']) . '</td>
                    <td>' . $customBooking['customer'] . '</td>
                    <td>' . $customBooking['members'] . '</td>
                    <td>' . number_format($customBooking['price'], 2, ".", ",") . '</td>
                    <td>Actions</td>
                  </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="../../js/bootstrap.bundle.js"></script>
<script src="../../js/pages/bookings/booking.js"></script>

</html>