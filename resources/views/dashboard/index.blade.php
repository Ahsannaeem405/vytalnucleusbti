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
                <h5 class="card-title">Levels</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>145</h6>
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
                <h5 class="card-title">Bins</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>3,264</h6>
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
                <h5 class="card-title">Rows</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>1244</h6>
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
                <h5 class="card-title">Boxes</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>1244</h6>
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
    <div class="col-12">
      <h4 class="mb-4">Level</h4>
      <table class="table table-bordered" id="eb-table">
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td class="text-center">
              <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td  class="text-center">
              <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td class="text-center">
              <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

</main>
@endsection
