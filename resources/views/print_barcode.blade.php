

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <div class="col-x col-lg-12 xl-12 col-md-12">
        <div class="card info-card sales-card">
          <div class="card-body">

            <div>{!! DNS1D::getBarcodeSVG($create->bar_code, 'C39',1.5,50,'black',true) !!}</div>
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
        document.location.href = "{{ url('/create_inventory_product') }}/{{$create->id}}";
    }
</script>
