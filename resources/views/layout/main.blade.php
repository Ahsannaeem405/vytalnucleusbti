<!DOCTYPE html>
<html lang="en">

<head>


  @section('head')
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4366d6f846.js" crossorigin="anonymous"></script>

    @include('/layout/css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  @show


</head>

<body>
@section('top-head')

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
              <span class="d-none d-md-block dropdown-toggle ps-2">  {{ Auth::user()->name }}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">


              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                 <i class="bi bi-box-arrow-right"></i>
                                 <span>Sign Out</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf


                </form>


              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->
    </div>

  </header><!-- End Header -->
@show
@section('aside')
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @yield('index') " href="{{url('index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link  @yield('product') collapsed" href="{{url('product')}}">
          <i class="bi bi-bar-chart"></i><span>Products</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  @yield('inventory') collapsed" href="{{url('inventory')}}">
          <i class="bi bi-bar-chart"></i><span>Inventory</span>
        </a>
      </li>
      @can('warehouse')

      <li class="nav-item">
        <a class="nav-link collapsed @yield('warehouse')" href="{{url('warehouse')}}">
          <i class="bi bi-bar-chart"></i><span>Warehouse</span>
        </a>
      </li>
      @endcan
      @can('levels')

      <li class="nav-item">
        <a class="nav-link collapsed @yield('levels')" href="{{url('levels')}}">
          <i class="bi bi-menu-button-wide"></i><span>Levels</span>
        </a>
      </li>
      @endcan
      @can('bins')

      <li class="nav-item">
        <a class="nav-link collapsed  @yield('bins')" href="{{url('bins')}}">
          <i class="bi bi-journal-text"></i><span>Bins</span>
        </a>
      </li>
      @endcan
      @can('rows')

      <li class="nav-item">
        <a class="nav-link collapsed  @yield('rows')" href="{{url('rows')}}">
          <i class="bi bi-layout-text-window-reverse"></i><span>Rows</span>
        </a>
      </li>
      @endcan
      @can('Boxes')

      <li class="nav-item">
        <a class="nav-link collapsed @yield('Boxes')" href="{{url('Boxes')}}">
          <i class="bi bi-bar-chart"></i><span>Boxes</span>
        </a>
      </li>
      @endcan
      @can('warehouse')

      <li class="nav-item">
        <a class="nav-link collapsed @yield('users')" href="{{url('users')}}">
          <i class="bi bi-bar-chart"></i><span>Users</span>
        </a>
      </li>
      @endcan
      @can('warehouse')

      <li class="nav-item">
        <a class="nav-link collapsed  @yield('roles')" href="{{url('roles')}}" >
          <i class="bi bi-bar-chart"></i><span>Roles</span>
        </a>
      </li>
      @endcan

    </ul>

  </aside><!-- End Sidebar-->
@show
@yield('body_content')

<!-- End #main -->

  <!-- ======= Footer ======= -->
@section('footer')
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Brown tech init</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Brown Tech Int.</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@show
  <!-- Vendor JS Files -->
@section('js')

  @include('/layout/js')

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
  @if($errors->has('w_id'))
  toastr.options = {
      "closeButton": true,
      "progressBar": true
  }
  toastr.error("Please select wharehouse");
  @endif
  @if(Session::has('success'))
  toastr.options = {
      "closeButton": true,
      "progressBar": true
  }
  toastr.success("{{ session('success') }}");
  @endif
  @if(Session::has('error'))
  toastr.options = {
      "closeButton": true,
      "progressBar": true
  }
  toastr.error("{{ session('error') }}");
  @endif
  @if(Session::has('info'))
  toastr.options = {
      "closeButton": true,
      "progressBar": true
  }
  toastr.info("{{ session('info') }}");
  @endif
  @if(Session::has('warning'))
  toastr.options = {
      "closeButton": true,
      "progressBar": true
  }
  toastr.warning("{{ session('warning') }}");
  @endif
  </script>

@show
<script>
  $(document).ready(function(){

    $(document).on('change', '.select_ws', function() {

      var id=$(this).val();
      $(".level-loading").css('display','block');
      $(".bin-loading").css('display','block');
      $(".row-loading").css('display','block');
      $(".select_level").empty();
      $(".select_bin").empty();
      $(".select_row").empty();

      $.ajax({
          type: 'get',
          url: "{{ url('/get_level') }}",
          data: {
              'id': id
          },
          success: function(response) {

              $(".select_level").empty().append(response);
              $(".level-loading").css('display','none');
              $(".bin-loading").css('display','none');
              $(".row-loading").css('display','none');
          }
      });

    });
    $(document).on('change', '.select_level', function() {

      var id=$(this).val();

      $(".bin-loading").css('display','block');
      $(".row-loading").css('display','block');
      $(".select_bin").empty();
      $(".select_row").empty();

      $.ajax({
          type: 'get',
          url: "{{ url('/get_bins') }}",
          data: {
              'id': id
          },
          success: function(response) {

              $(".select_bin").append(response);
              $(".bin-loading").css('display','none');
              $(".row-loading").css('display','none');
          }
      });

    });
    $(document).on('change', '.select_bin', function() {

      var id=$(this).val();

        $(".row-loading").css('display','block');
      $(".select_row").empty();

      $.ajax({
          type: 'get',
          url: "{{ url('/get_row') }}",
          data: {
              'id': id
          },
          success: function(response) {

              $(".select_row").append(response);

              $(".row-loading").css('display','none');
          }
      });

    });



  });
</script>



</body>

</html>
