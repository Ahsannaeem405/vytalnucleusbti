<!DOCTYPE html>
<html lang="en">

<head>


  @section('head')
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4366d6f846.js" crossorigin="anonymous"></script>

    @include('/layout/css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>


  @show



</head>

<body>

@section('top-head')

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{url('/')}}" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">Express Build</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="d-flex eb-menu-search-bar">
      <div class="search-bar">
        <div class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" class="search_global_product" value="@if(isset($_GET['upc'])) {{$_GET['upc']}} @endif" placeholder="Search Product Upc" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </div>
      </div><!-- End Search Bar -->

      <nav class="header-nav">
        <ul class="d-flex align-items-center">

          <li class="nav-item d-block d-lg-none eb-nav-item">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li><!-- End Search Icon-->

          <li class="nav-item dropdown pe-3 mt-2">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="color: white;">
              <span class="d-none d-md-block dropdown-toggle ps-2">  {{ Auth::user()->name }}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">


              <li>
                <a  class="dropdown-item" href="{{ route('logout') }}"
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
        <a class="nav-link  @yield('create_product') collapsed" href="{{url('product')}}">
          <i class="bi bi-bar-chart"></i><span>Products</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  @yield('inventory') collapsed" href="{{url('inventory')}}">
          <i class="bi bi-bar-chart"></i><span>Inventory</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  @yield('orders') collapsed" href="{{url('orders')}}">
          <i class="bi bi-bar-chart"></i><span>Orders</span>
        </a>
      </li>



      <!-- @can('Boxes')

      <li class="nav-item">
        <a class="nav-link collapsed @yield('Boxes')" href="{{url('Boxes')}}">
          <i class="bi bi-bar-chart"></i><span>Boxes</span>
        </a>
      </li>
      @endcan -->
      @can('warehouse')
      <li class="nav-item">
        <a class="nav-link collapsed @yield('warehouse')" href="{{url('warehouse')}}">
          <i class="bi bi-bar-chart"></i><span>Warehouse</span>
        </a>
      </li>
      @endcan
        <!-- <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Location</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapse @yield('show')" data-bs-parent="#sidebar-nav">
            @can('warehouse')
            <li>
              <a class="@yield('warehouse')" href="{{url('warehouse')}}">
                <i class="bi bi-circle"></i><span>Warehouse</span>
              </a>
            </li>
            @endcan
            @can('levels')
            <li>
              <a class="@yield('levels')" href="{{url('levels')}}">
                <i class="bi bi-circle"></i><span>Levels</span>
              </a>
            </li>
            @endcan
            @can('bins')
            <li>
              <a class="@yield('bins')" href="{{url('bins')}}">
                <i class="bi bi-circle"></i><span>Bins</span>
              </a>
            </li>
            @endcan
            @can('rows')
            <li>
              <a class="@yield('rows')" href="{{url('rows')}}">
                <i class="bi bi-circle"></i><span>Rows</span>
              </a>
            </li>
            @endcan

          </ul>
        </li> -->










      @can('warehouse')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>User Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav2" class="nav-content collapse @yield('show_2')" data-bs-parent="#sidebar-nav">

          <li>
            <a class="@yield('users')" href="{{url('users')}}">
              <i class="bi bi-bar-chart"></i><span>Users</span>
            </a>
          </li>
          <li>
            <a class="@yield('roles')" href="{{url('roles')}}" >
              <i class="bi bi-bar-chart"></i><span>Roles</span>
            </a>
          </li>
        </ul>
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
      &copy; Copyright <strong><span>Brown tech int</span></strong>. All Rights Reserved
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
    $(document).on('keyup', '.bar_code', function() {

      $(".invalid-feedback").css('display','none');
      $(".genrate_box").attr("disabled", true);

      var id=$(this).val();
      $(".bar_code_append").val(id);
      $(".bar_code-loading").css('display','block');




      $.ajax({
          type: 'get',
          url: "{{ url('/check_box') }}",
          data: {
              'id': id
          },
          success: function(response) {
              $(".bar_code-loading").css('display','none');
              if(response==200)
              {
                $(".invalid-feedback").css('display','none');
                $(".genrate_box").attr("disabled", false);
              }
              else{
                $(".invalid-feedback").css('display','block');
                $(".genrate_box").attr("disabled", true);
              }
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
    $(document).on('keydown','.search_global_product', function(e) {


      if(e.which == 13) {
        var box_id=$('.search_global_product').val();
          $.ajax({
              type: 'get',
              url: "{{ url('/search_global_product') }}",
              data: {
                  'box_id':box_id
              },
              success: function(response) {
                $('.main').empty().append(response);

              }
          });

        }






    });



  });
</script>



</body>

</html>
