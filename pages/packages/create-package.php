<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create package | Tour Operator System</title>
  <link rel="shortcut icon" href="../../images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/global.css">
  <link rel="stylesheet" href="../../css/package/create-package.css">
</head>

<body id="override">
  <div class="modal fade" id="confirmLeavingModal" tabindex="-1" aria-labelledby="confirmLeavingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6" id="confirmLeavingModalLabel">Are you sure you want to cancel package creation?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Changes may not be saved.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
          <a type="button" class="btn btn-secondary" id="confirmLink" href="#">Confirm</a>
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
                <a class="nav-link" href="../bookings/bookings.php">Bookings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Packages</a>
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
              <ol class="breadcrumb align-items-center">
                <li class="breadcrumb-item"><a href="packages.php" class="text-decoration-none">Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create package</li>
              </ol>
            </nav>
            <h4>Create package</h4>
            <a href="../packages/packages.php">Go back to packages</a>
          </div>
        </div>
      </div>
    </div>
    <div class="container-sm pt-5">
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="pt-2 col-12 col-md-8 mx-auto">
            <div class="form-part" id="basicDetailsPart">
              <h6 class="fw-lighter mb-4 text-muted">Basic details</h6>
              <div class="mb-5">
                <input type="text" class="form-control" name="packageTitle" id="packageTitle" placeholder="Trip to Tokyo" autofocus required autocomplete="FALSE" aria-describedby="packageTitleHelpBlock" />
                <div class="invalid-feedback">
                  Please provide title for your package.
                </div>
                <small id="packageTitleHelpBlock" class="text-muted">Title</small>
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
                <div class="row">
                  <div class="col-12">
                    <label for="duration" class="form-label">Duration</label>
                    <div class="input-group has-validation mb-3">
                      <input type="number" class="form-control" min="1" aria-label="Duration" id="duration" placeholder="0" required>
                      <span class="input-group-text">days</span>
                      <div class="invalid-feedback">
                        Please provide duration of the tour.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-12">
                    <label for="minNumOfMembers" class="form-label">Members</label>
                    <div class="input-group has-validation members">
                      <input type="number" class="form-control" min="1" aria-label="Minimum" id="minNumOfMembers" required max="20" placeholder="1" aria-labelledby="membersHelpBlock">
                      <span class="input-group-text">to</span>
                      <input type="number" class="form-control" min="1" aria-label="Maximum" id="maxNumOfMembers" required max="20" placeholder="20">
                      <div class="invalid-feedback">
                        Please provide the minimum and/or maximum members that can avail the tour or check if the value you entered is correct.
                      </div>
                    </div>
                    <small id="membersHelpBlock" class="text-muted">Set the minimum (1) and maximum (20) members of the tour that can avail the package.</small>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-12">
                    <label for="price" class="form-label">Package price</label>
                    <div class="input-group has-validation mb-3">
                      <span class="input-group-text">PHP</span>
                      <input type="number" class="form-control" aria-label="Price amount" id="price" placeholder="0.00" required>
                      <div class="invalid-feedback">
                        Please provide price for your package.
                      </div>
                    </div>
                  </div>
                </div>
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
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end">
                <button type="button" id="basicDetailsNextButton" class="btn btn-primary my-5">
                  Next
                </button>
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

          </div>
          <div class="form-part d-none" id="summaryPart">
            <h6 class="fw-lighter mb-4 text-muted">Summary</h6>
            <div class="card mb-4 p-3">
              <div class="card-body">
                <h4 class="card-title mb-3">Package summary</h4>
                <div id="cardContent" class="card-text">
                </div>
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
        </div>
      </form>
    </div>
  </main>
  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/global.js"></script>
  <script src="../../js/pages/packages/create-package.js"></script>
</body>


</html>