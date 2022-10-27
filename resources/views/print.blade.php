

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <div class="col-x col-lg-3 xl-3 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">{{$create->name}}</h5>

            <div>{!! DNS1D::getBarcodeSVG($create->bar_code, 'C39',1.5,50,'black',true) !!}</div>
            <div class="d-flex align-items-center"  style="padding: 20px 0 0 0;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Row:</h5>
              </div>
              <div class="ps-3">

                  <h6>{{$create->row_id}}</h6>

              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Bin:</h5>
              </div>
              <div class="ps-3">

                  <h6>{{$create->bin_id}}</h6>

              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Level:</h5>
              </div>
              <div class="ps-3">

                  <h6>{{$create->level_id}}</h6>
              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <h5>Warehouse:</h5>
              </div>
              <div class="ps-3">
                @if($create->get_ws !=null)
                  <h6>{{$create->get_ws->name}}</h6>
                @endif
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function () {
        window.print();
        setTimeout("closePrintView()", 3000);
    });
    function closePrintView() {
        document.location.href = "{{ url('/Boxes') }}";
    }
</script>
