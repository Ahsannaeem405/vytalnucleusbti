<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Create Product - Express Build</title>
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

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Create Product</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="eb-table-wrp mt-5">
      <div class="col-12">
        <form class="g-3 eb-pro-dtl" novalidate style="color: #000;">

          <!-- product info -->
          <div class="row eb-pro-dtl-info eb-pro-dtl-wrp mb-5">
            <div class="col-3 eb-ware-house-prnt">
              <label for="ware_house" class="form-label">Warehouse</label>
              <input type="text" name="name" class="form-control" id="ware_house">
              <span class="input-group-btn Warehouse-modal">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalWarehouse"><i class="fas fa-plus" aria-hidden="true"></i></button>
              </span>
            </div>
            <div class="col-3">
              <label for="product_sku" class="form-label">Level</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>1</option>
                <option value="1">2</option>
                <option value="2">3</option>
              </select>
            </div>
            <div class="col-3">
              <label for="product_sku" class="form-label">Bins</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>A</option>
                <option value="1">B</option>
                <option value="2">C</option>
              </select>
            </div>
            <div class="col-3">
              <label for="product_sku" class="form-label">Row</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>7</option>
                <option value="1">8</option>
                <option value="2">9</option>
              </select>
            </div>
            <div class="col-3">
              <label for="product_sku" class="form-label">Box Name</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>box name</option>
                <option value="1">box name</option>
                <option value="2">box name</option>
              </select>
            </div>
          </div>

          <!-- product detailing -->
          <div class="row eb-pro-details eb-pro-dtl-wrp mb-5">
              <div class="box-body ">
                  <div class="mt-2 mb-4">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-btn me-3">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalBarcode"><i class="fa fa-barcode"></i></button>
                        </span>
                        <input class="form-control eb-barcode-input" id="search_product" placeholder="Enter Product name / SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off">
                        <span class="input-group-btn ms-3">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="pos_product_div">
                    <div class="table-responsive">
                      <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                        <thead>
                          <tr>
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">Product Name</td>
                            <td class="text-center">50</td>
                            <td class="text-center">$10</td>
                            <td class="text-center">2%</td>
                            <td class="text-center">$10</td>
                          </tr>
                          <tr>
                            <td class="text-center">Product Name</td>
                            <td class="text-center">50</td>
                            <td class="text-center">$10</td>
                            <td class="text-center">2%</td>
                            <td class="text-center">$10</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-condensed table-bordered table-striped">
                        <tbody>
                          <tr>
                           <td>
                              <div class="pull-right">
                              <b>Items:</b> 
                              <span class="total_quantity">0.00</span>
                              <b class="ms-2">Total: </b>
                                <span class="price_total">0.00</span>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>


          <!-- product button -->
          <div class="row eb-pro-btn">
            <button class="btn btn-primary eb-user-form-btn" type="submit">Save</button>
          </div>
        </form>
      </div>
    </section>

    <section class="eb-pro-dtl">
      <!-- modal -->
      <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form class="row g-3 needs-validation" novalidate style="color: #000;">
                <div class="col-12 eb-user-form-wrp d-flex gap-2">
                  <div class="col-6">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="product_name" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>
                  <div class="col-6">
                    <label for="product_sku" class="form-label">Product SKU</label>
                    <input type="text" name="name" class="form-control" id="product_sku" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>
                </div>
                <div class="col-12 my-2 text-center">
                  <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit">Add Product</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- modal bar code -->
      <div class="modal fade" id="largeModalBarcode" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Product name
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                  <label class="form-check-label" for="flexCheckChecked">
                    SKU
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                  <label class="form-check-label" for="flexCheckChecked">
                    Lot Number
                  </label>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- warehouse modal -->
      <div class="modal fade" id="largeModalWarehouse" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form>
                <h2>select ware house</h2>
              </form>
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