<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookings | Tour Operator System</title>
  <link rel="shortcut icon" href="../../images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/global.css">
  <link rel="stylesheet" href="../../css/booking/new-booking.css">
</head>

<div class="wrapper">

  <body id="override">
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="needs-validation modal-content" id="form" novalidate>
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Customer Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-muted fw-light fst-italic" style="font-size: small !important;">Fields marked with <span class="text-danger">*</span> are required</p>
            <div class="row">
              <div class="mb-3 col-12 col-sm-9">
                <label for="firstName" class="form-label">First Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="firstName" required name="firstName" autofocus>
                <div class="invalid-feedback">
                  First name can't be empty
                </div>
              </div>

              <div class="mb-3 col-12 col-sm-3">
                <label for="middleInitial" class="form-label">M.I</label>
                <input type="text" class="form-control" id="middleInitial" maxlength="1" name="middleInitial">
              </div>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="lastName" required name="lastName">
              <div class="invalid-feedback">
                Last name can't be empty.
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
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
    <div class="modal fade" id="confirmLeavingModal" tabindex="-1" aria-labelledby="confirmLeavingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-6" id="confirmLeavingModalLabel">Are you sure you want to cancel adding booking?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Changes may not be saved.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-secondary not-exit" id="confirmLink" href="#">Confirm</a>
          </div>
        </div>
      </div>
    </div>
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
                  <a class="nav-link active" aria-current="page" href="bookings.php">Bookings</a>
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
      <div class="container-fluid shadow-sm pb-4">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../../index.php" class="text-decoration-none">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="bookings.php" class="text-decoration-none">Bookings</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add custom booking</li>
                </ol>
              </nav>
              <h4>Add custom bookings</h4>
              <p class="text-secondary">Add custom tour bookings</p>
            </div>
          </div>
        </div>
      </div>

      <div class="container-sm pt-2 col-12 col-md-8 mx-auto">
        <div class="fit-content card p-3 mt-3 mb-4">
          <div class="form-check-reverse form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="quickBook">
            <label class="form-check-label" for="quickBook">Quick book</label>
          </div>
        </div>
        <form class="needs-validation" novalidate id="addBookingsForm">
          <div id="basicDetailsPart" class="form-part">
            <div class="mb-3">
              <label for="customStartDate">Start Date</label>
              <input type="date" class="form-control" id="customStartDate" required>
              <div class="invalid-feedback">
                Please provide the start date of the tour
              </div>
            </div>
            <div class="mb-3">
              <label for="customEndDate">End Date</label>
              <input type="date" class="form-control" id="customEndDate" disabled required>
              <div class="invalid-feedback">
                Please provide the start date of the tour
              </div>
            </div>
            <div class="mb-3">
              <label for="destination" class="form-label">Destination</label>
              <div class="row">
                <div class="col-12">
                  <input type="text" name="destination" id="destination" class="form-control" placeholder="Tokyo, Japan" required />
                  <div class="invalid-feedback">
                    Please provide destination of the tour.
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="members" class="form-label">Members</label>
              <input type="number" class="form-control" name="members" id="members" aria-describedby="membersHelpBlock" max="20" min="1" required />
              <div class="invalid-feedback">
                Please provide the number of members that can avail the tour or check if the value you entered is correct.
              </div>
              <small id="membersHelpBlock" class="form-text text-muted">How many person are joining the tour?</small>
            </div>
            <!-- Customer Selection -->
            <div class="mb-3">
              <label for="customer" class="form-label">Customer</label>
              <input class="form-control" name="customer" id="customer" placeholder="Search customer..." list="customerOptions" aria-labelledby="customerHelpBlock" required />
              <div class="invalid-feedback">
                Please provide the customer.
              </div>
              <datalist id="customerOptions">
                <?php
                $customers = $_SESSION['customers'];
                for ($i = 0; $i < sizeof($customers); $i++) {
                  $customer = $customers[$i];
                  echo "<option value='" . $customer['fullName'] . "'>";
                }
                ?>
              </datalist>
              <small id="customerHelpBlock" class="form-text text-muted visually-hidden">This customer is not in our list, please <a type="button" role="button" id="addCustomerModalToggler" class="link-primary not-exit">add it first</a>.</small>
            </div>
            <div class="mb-3">

              <div class="row">
                <div class="col-12">
                  <div class="card border-primary p-4">
                    <div class="commodities mb-4">
                      <p class="fw-bold">Accommodation</p>
                      <div class="ms-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="1star" id="oneStarHotel" name="accommodation" required>
                          <label class="form-check-label" for="oneStarHotel">
                            1 Star Hotel
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="2star" id="twoStarHotel" name="accommodation">
                          <label class="form-check-label" for="twoStarHotel">
                            2 Star Hotel
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="3star" id="threeStarHotel" name="accommodation">
                          <label class="form-check-label" for="threeStarHotel">
                            3 Star Hotel
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="4star" id="fourStarHotel" name="accommodation">
                          <label class="form-check-label" for="fourStarHotel">
                            4 Star Hotel
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="5star" id="fiveStarHotel" name="accommodation">
                          <label class="form-check-label" for="fiveStarHotel">
                            5 Star Hotel
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="commodities mb-4">
                      <p class="fw-bold">Food</p>
                      <div class="ms-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="dine" id="dine" name="food" required>
                          <label class="form-check-label" for="dine">
                            Dine
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="packed" id="packed" name="food">
                          <label class="form-check-label" for="packed">
                            Packed
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="commodities mb-4">
                      <p class="fw-bold">Transportation</p>
                      <span class="text-muted fw-light">On arrival before the start date of booking and departure after the tour.</span>
                      <div class="ms-4 mt-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="free" id="free" name="transportation" required>
                          <label class="form-check-label" for="free">
                            Free <span class="text-muted">(included in the package)</span>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="separate" id="separate" name="transportation">
                          <label class="form-check-label" for="separate">
                            Separate <span class="text-muted">(customers pay their own transportation)</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="button" id="basicDetailsNextButton" class="btn btn-primary my-4">
                      Next
                    </button>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="form-part d-none" id="itineraryPart">
            <h6 class="fw-lighter mb-4 text-muted">Itinerary</h6>
            <div class="accordion" id="itineraryInputContainer">
            </div>
            <div class="d-flex justify-content-between">
              <button type="button" id="itineraryBackButton" class="btn btn-secondary my-5">
                Back
              </button>
              <button class=" btn btn-primary my-5" type="button" id="itineraryNextButton">
                Next
              </button>
            </div>
          </div>
          <div class="form-part d-none" id="summaryPart">
            <h6 class="fw-lighter mb-4 text-muted">Summary</h6>
            <div class="card mb-4 p-3">
              <div class="card-body">
                <h4 class="card-title mb-3">Package summary</h4>
                <div id="cardContent" class="card-text">
                </div>
                <p class="fw-bold fs-5">PHP 100,000.00</p>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <button type="button" id="summaryBackButton" class="btn btn-secondary my-5">
                Back
              </button>
              <button type="button" id="summaryFinishButton" class="btn btn-primary my-5">
                Finish
              </button>
            </div>
          </div>
        </form>
      </div>

    </main>
    <script src="../../js/bootstrap.bundle.js"></script>
    <script src="../../js/pages/bookings/custom-booking.js"></script>
  </body>
</div>

</html>