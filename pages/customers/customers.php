<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customers | Tour Operator System</title>
  <link rel="shortcut icon" href="../../images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/global.css">
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
                <a class="nav-link" href="../bookings/bookings.php">Bookings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../packages/packages.php">Packages</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Customers</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="needs-validation modal-content" id="form" novalidate>
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Customer Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-muted fw-light fst-italic" style="font-size: small !important;">Fields marked with <span class="text-danger">*</span> are required</p>
            <div class="row">
              <div class="mb-3 col-12 col-sm-8">
                <label for="lastName" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="lastName" required name="lastName">
                <div class="invalid-feedback">
                  Last name can't be empty.
                </div>
              </div>
              <div class="mb-3 col-12 col-sm-4">
                <label for="middleInitial" class="form-label">M.I</label>
                <input type="text" class="form-control" id="middleInitial" maxlength="1" name="middleInitial">
              </div>
            </div>
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="firstName" required name="firstName">
              <div class="invalid-feedback">
                First name can't be empty
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</span></label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number<span class="text-danger">*</span></label>
              <input type="tel" class="form-control" id="phone" required name="phone">
              <div class="invalid-feedback">
                Please provide contact number.
              </div>
            </div>
            <label for="paymentMethod" class="form-label">Payment Method<span class="text-danger">*</span></label>
            <div class="mb-3 px-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="creditCard" id="creditCard" name="paymentMethod">
                <label class="form-check-label" for="creditCard">
                  Credit Card
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="debitCard" id="debitCard" name="paymentMethod">
                <label class="form-check-label" for="debitCard">
                  Debit Card
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="bankTransfer" id="bankTransfer" name="paymentMethod">
                <label class="form-check-label" for="bankTransfer">
                  Bank Transfer
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="eWallet" id="eWallet" name="paymentMethod">
                <label class="form-check-label" for="eWallet">
                  E-Wallet
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="mobilePayment" id="mobilePayment" name="paymentMethod">
                <label class="form-check-label" for="mobilePayment">
                  Mobile Payment
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="prepaidCard" id="prepaidCard" name="paymentMethod">
                <label class="form-check-label" for="prepaidCard">
                  Prepaid Card
                </label>
                <div class="invalid-feedback">
                  Please select at least one payment method.
                </div>
              </div>
            </div>
            <button class="btn btn-primary mt-2 mb-4 float-end" type="submit">Add customer</button>
          </div>
        </form>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h4 class="mt-4">Customers</h4>
          <p class="text-secondary">Manage customers.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-auto ms-md-auto">
          <button name="addCustomer" id="addCustomer" class="btn btn-primary w-100 w-md-auto" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Add customer</button>
        </div>
      </div>
      <div class="row mt-3">
        <div class="table-responsive card">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php
              $customers = $_SESSION['customers'];
              for ($i = 0; $i < sizeof($customers); $i++) {
                $customer = $customers[$i];
                $paymentMethods = $customer['paymentMethod'];
                $paymentMethodElement = "";
                for ($j = 0; $j < count($paymentMethods); $j++) {
                  $paymentMethodElement = $paymentMethodElement . "<li>" . $paymentMethods[$j] . "</li>";
                }
                echo "<tr>
                <th scope='row'>" . $i ."</th>
                <td>" . $customer['firstName'] . " " . $customer['lastName'] . "</td>
                <td>" . $customer['phone'] . "</td>
                <td>" . $paymentMethodElement ."</td>
                <td>Actions</td>
              </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/pages/customers/add-customer.js"></script>
</body>

</html>