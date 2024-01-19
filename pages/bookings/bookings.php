<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Packages | Tour Operator System</title>
  <link rel="shortcut icon" href="../../images/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <!-- <link rel="stylesheet" href="css/bootstrap-utilities.css"> -->
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
              <li class="breadcrumb-item active" aria-current="page">Packages</li>
            </ol>
          </nav>
          <h4>Packages</h4>
          <p class="text-secondary">Create and manage packages.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-auto ms-md-auto">
          <a name="newPackageButton" id="newPackageButton" class="btn btn-primary w-100 w-md-auto" href="create-package.php" role="button">Create new package</a>
        </div>
      </div>
      <div class="row mt-3">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Icon</th>
                <th scope="col">Status</th>
                <th scope="col">Product&nbsp;code</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="../../js/bootstrap.bundle.js"></script>

</html>