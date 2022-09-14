<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inventory - Express Build</title>
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
    </div><!-- End Logo -->
    <div class="d-flex eb-menu-search-bar">
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div><!-- End Search Bar -->

      <nav class="header-nav">
        <ul class="d-flex align-items-center">

          <li class="nav-item d-block d-lg-none eb-nav-item">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li><!-- End Search Icon-->

          <li class="nav-item dropdown pe-3 mt-2">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
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

            </ul><!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->
    </div>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
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
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-bar-chart"></i><span>warehouse</span>
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
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-bar-chart"></i><span>Roles</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Inventory</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Inventory</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12 eb-card-wrp eb-inventory-card-wrp mt-5">
          <div class="row">
            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <a class="card-title" href="details.php"ss>Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            <div class="col-x col-lg-3 xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <a class="card-title" href="details.php">Box Name</a>
                </div>
              </div>
            </div>

            
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Brown tech init</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Brown Tech Int.</a>
    </div>
  </footer><!-- End Footer -->

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>