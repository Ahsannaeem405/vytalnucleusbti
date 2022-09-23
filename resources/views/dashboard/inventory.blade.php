@extends('../layout/main')
@section('inventory')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Inventory</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Inventory</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="row eb-card-wrp">
      <?php foreach ($Box as $value): ?>


      <div class="col-x col-lg-3 xl-3 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">{{$value->name}}</h5>

            <div>{!! DNS1D::getBarcodeHTML($value->bar_code, 'C39',1,33) !!}</div>
            <div class="d-flex align-items-center"  style="padding: 20px 0 0 0;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Row:</h5>
              </div>
              <div class="ps-3">
                @if($value->get_row !=null)
                  <h6>{{$value->get_row->name}}</h6>
                @endif
              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Bin:</h5>
              </div>
              <div class="ps-3">
                @if($value->get_bin !=null)
                  <h6>{{$value->get_bin->name}}</h6>
                @endif
              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Level:</h5>
              </div>
              <div class="ps-3">
                @if($value->get_level !=null)
                  <h6>{{$value->get_level->name}}</h6>
                @endif
              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Wharehouse:</h5>
              </div>
              <div class="ps-3">
                @if($value->get_ws !=null)
                  <h6>{{$value->get_ws->name}}</h6>
                @endif
              </div>
            </div>


          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </section>

</main>
@endsection
