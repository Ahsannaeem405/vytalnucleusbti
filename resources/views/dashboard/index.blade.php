@extends('../layout/main')
@section('index')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- main columns -->
      <div class="col-lg-12 eb-card-wrp">
        <div class="row">
          <!-- Level Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Warehouse</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-location-arrow"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Wharehouse)}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Levels Card -->

          <!-- Bins Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Level</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-level-up"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Level)}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Bins Card -->

          <!-- Roles Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Bins</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-columns"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Bin)}}</h6>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- End Roles Card -->

          <!-- Boxes Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Rows</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-columns"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Row)}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="eb-table-wrp">
    <div class="row">
      <div class="col-md-6">
        <h4 class="mb-4">Warehouse</h4>
        <table class="table table-bordered" id="eb-table">
          <thead>
            <tr>
              <th scope="col" class="text-center">ID</th>
              <th scope="col">Title</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0; ?>
            @foreach($Wharehouse as $value)
            <?php $i++; ?>


            <tr>
              <th scope="row" class="text-center">{{$i}}</th>
              <td>{{$value->name}} </td>

            </tr>
            @if($i==10)
              @break
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h4 class="mb-4">Level</h4>
        <table class="table table-bordered" id="eb-table">
            <!-- @can('level_store')
              <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
            @endcan -->
          <thead>
            <tr>
              <th scope="col" class="text-center">ID</th>
              <th scope="col">Level Name</th>

              <th scope="col" class="">Warehouse</th>
            </tr>
          </thead>
          <tbody>
            <?php $il=0; ?>
            @foreach($Level as $row_level)
            <?php $il++; ?>
            <tr>
              <th scope="row" class="text-center">{{$il}}</th>

              <td>{{$row_level->level_id}} </td>
              <td>{{$row_level->get_ws->name}}</td>

              <!-- <td class="text-center">
                  @can('level_update')
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$i}}"><i class="fas fa-edit"></i></button>
                  @endcan
                  @can('level_Delete')
                    <button type="button" class="btn btn-danger del_level" del_id="{{$row_level->id}}"><i class="far fa-trash-alt"></i></button>
                  @endcan
              </td> -->
            </tr>
            @if($il==10)
              @break
            @endif
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </section>

</main>
@endsection
