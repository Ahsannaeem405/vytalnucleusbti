<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users - Express Build</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- --------- -->
  <script src="https://kit.fontawesome.com/4366d6f846.js" crossorigin="anonymous"></script>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">Express Build</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    <div class="d-flex eb-menu-search-bar">
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div>
      <!-- End Search Bar -->

      <nav class="header-nav">
        <ul class="d-flex align-items-center">

          <li class="nav-item d-block d-lg-none eb-nav-item">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li>
          <!-- End Search Icon-->

          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
            </a>
            <!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>Kevin Anderson</h6>
                <span>Web Designer</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>

            </ul>
            <!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->

        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </div>

  </header>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="product.php">
          <i class="bi bi-bar-chart"></i><span>Products</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="inventory.php">
          <i class="bi bi-bar-chart"></i><span>Inventory</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="warehouse.php">
          <i class="bi bi-bar-chart"></i><span>Warehouse</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="levels.php">
          <i class="bi bi-menu-button-wide"></i><span>Levels</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="bins.php">
          <i class="bi bi-journal-text"></i><span>Bins</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="rows.php">
          <i class="bi bi-layout-text-window-reverse"></i><span>Rows</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="Boxes.php">
          <i class="bi bi-bar-chart"></i><span>Boxes</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users.php">
          <i class="bi bi-bar-chart"></i><span>Users</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="roles.php">
          <i class="bi bi-bar-chart"></i><span>Roles</span>
        </a>
      </li>

    </ul>

  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="eb-table-wrp mt-5">
      <div class="col-12">
        <table class="table table-bordered" id="eb-table">
          <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
          <thead>
            <tr>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">User Name</th>
              <th scope="col">Password</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>john</td>
              <td>Snow</td>
              <td>johnsnow@gmail.com</td>
              <td>John_Snow</td>
              <td>-------</td>
              <td class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>
            <tr>
              <td>john</td>
              <td>Snow</td>
              <td>johnsnow@gmail.com</td>
              <td>John_Snow</td>
              <td>-------</td>
              <td class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>
            <tr>
              <td>john</td>
              <td>Snow</td>
              <td>johnsnow@gmail.com</td>
              <td>John_Snow</td>
              <td>-------</td>
              <td class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- modal -->
        <div class="modal fade" id="largeModal" tabindex="-1">
          <div class="modal-dialog eb-modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate>
                  <h1 class="text-center">User Information</h1>
                  <div class="col-12 eb-user-form-wrp d-flex">
                    <div class="col-12">
                      <label for="first_name" class="form-label">First Name</label>
                      <input type="text" name="name" class="form-control" id="first_name" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                  </div>
                  <div class="col-12 eb-user-form-wrp d-flex">
                    <div class="col-12">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input type="text" name="name" class="form-control" id="last_name" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                  </div>

                  <div class="col-12 eb-user-form-wrp d-flex">
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                  </div>

                  <div class="col-12 eb-user-form-wrp d-flex">
                    <div class="col-12">
                      <label for="Username" class="form-label">User Name</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="Username" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 eb-user-form-wrp d-flex">
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                  </div>
                  <div class="col-12 my-2 text-center">
                    <button class="btn btn-primary w-50 mt-3 eb-user-form-btn" type="submit">Create User</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal Edit -->
        <div class="modal fade" id="largeModalEdit" tabindex="-1">
          <div class="modal-dialog eb-modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-4">
                    Are you sure you want to edit?
                  </div>
                  <div class="modal-footer eb-modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    <button type="button" class="btn btn-primary">Cancel</button>                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal Delete -->
        <div class="modal fade" id="largeModalDelete" tabindex="-1">
          <div class="modal-dialog eb-modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-4">
                    Are you sure you want to delete?
                  </div>
                  <div class="modal-footer eb-modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    <button type="button" class="btn btn-primary">Cancel</button>                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Brown tech init</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">Brown Tech Int.</a>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>