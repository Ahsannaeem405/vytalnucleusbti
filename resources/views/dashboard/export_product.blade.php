
<head>
<link  type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
<link   type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
<link  type="text/css" rel="stylesheet"  href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" />
</head>
<style>
body{
  display: none;
}
.tooltip-inner {
    max-width: 500px !important;
}
label{
  font-weight: bolder;
}
.select2 {
  width: 100%!important;
}
</style>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="eb-table-wrp mt-5">

    <div class="col-md-12">
      <div class="table-responsive">

      <table class="table table-bordered" id="eb-table">

        <thead>
          <tr>

            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Image</th>
            <th scope="col">Quantity</th>
            <th scope="col">Reserved Quantity</th>

            <th scope="col">Cost</th>
            <th scope="cl">Price</th>
            <th scope="col" >Upc</th>
            <th scope="cl">Variant/Color</th>
            <th scope="col" >Sku</th>
            <th scope="col" >Uploaded Status</th>
            <th scope="col" >Inventory Location</th>
            <th scope="col" >Categories</th>
            <th scope="col" >Tags</th>




          </tr>
        </thead>
        <tbody>
          @php $p=0; @endphp
          @foreach($product as $row)
          @php $p++; @endphp
          <tr>
            <td>{{$row->name}}</td>
            <td>{{$row->description}}</span></td>
            <td><a href="{{$row->image}}">image1</a> ,
              @php $im=1; @endphp
              @foreach($row->images as $img)
              @php $im++; @endphp
              <a href="{{asset('upload/images/' .$img->image_id)}}">image{{$im}}</a> ,
              @endforeach
            </td>
            <td>{{$row->qty}}</td>
            <td>{{$row->r_qty}}</td>
            <td>{{$row->cost}}</td>
            <td>{{$row->price}}</td>
            <td >{{$row->upc}}</td>
            <td>{{$row->vc}}</td>
            <td>{{$row->sku}}</td>
            <td>
              @if($row->upload==null)
              No
              @else
              yes
              @endif
            </td>
            <td>{{$row->box_id}}
              Bin:{{$row->get_box->bin_id}}
              Level:{{$row->get_box->level_id}}
              Row:{{$row->get_box->row_id}}


            </td>
            <td>
              <?php foreach ($row->categories as $key => $value): ?>
                {{$value->categories_name->title}},
              <?php endforeach; ?>
            </td>
            <td>{{$row->tag}}

            </td>


          </tr>

          @endforeach

        </tbody>
      </table>
      <!-- End Large Modal-->
    </div>
      </div>
  </section>

</main><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<script>
$(document).ready(function() {
    var table = $('#eb-table').DataTable( {
        lengthChange: false,
        "paging": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#eb-table_wrapper .col-md-6:eq(0)' );
        $('.buttons-excel').click();
        var url = "{{ url('product') }}";
	      location.href = url;
});
</script>
