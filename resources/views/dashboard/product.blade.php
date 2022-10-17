@extends('../layout/main')
@section('product')
side_bar_active
@endsection
@section('body_content')

<style>
.tooltip-inner {
    max-width: 500px !important;
}
label{
  font-weight: bolder;
}
.select2 {
  width: 100%!important;
}
.price,.cost{
  border: 1px solid #fff!important;
    width: 80px;
    height: 41px;
    padding: 4%;
    border-radius: 6%;
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
  <form class=""   method="POST" action="{{ url('export_product') }}">
@csrf
  <section class="eb-table-wrp mt-5">
    <div class="row">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="" class="form-label" style="color: black;">Filters</label>
          <select class="form-select product_filter " name="w_id" aria-label="Default select example" >
            <option value="" selected="">Select Filters</option>
            <option value="1">Recently added</option>
            <option value="name">Missing Title(s)</option>
            <option value="description">Missing Description(s)</option>
            <option value="price">Missing Price(s)</option>
            <option value="cat">Missing Categories</option>
            <option value="image">Missing Image(s)</option>
            <option value="qty">In-Stock</option>
            <option value="out_qty">Out-of-Stock</option>
            <option value="upload">Uploaded</option>
            <option value="non_upload">Not Uploaded</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="" class="form-label" style="color: black;">Wharehouse</label></label>
          <select class="form-select product_wharehouse" name="" aria-label="Default select example" >
            <option value="" selected="">Select Wharehouse</option>
            @foreach($All_Box as $box)
              <option value="{{$box->id}}">{{$box->name}}</option>
            @endforeach

          </select>
        </div>
      </div>

    </div>

    <div class="col-12 mb-5">
      <a type="button" class="btn btn-primary " href="{{url('create_product')}}" style="float:right;border:1px solid #e52092;background-image: linear-gradient(180deg, #e52092, #982cba);"><i class="fas fa-plus"></i> New Product</a>
      <input type="submit" class="btn btn-primary " name="type" value="Export"  style="margin-right: 1%;float:right;border:1px solid #e52092;background-color:white;color:#e52092;">
      <input type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#import_product" name="type" value="Import"  style="margin-right: 1%;float:right;border:1px solid #e52092;background-color:white;color:#e52092;">


    </div>
    <div class="col-12 pt-3 append_product" >
      <table class="table table-bordered" id="eb-table">

        <thead>
          <tr>
            <th scope="col" class="text-center"> <div class="form-group form-check">
                <input type="checkbox" class="form-check-input checkAll"  id="exampleCheck1">
              </div>
            </th>
            <th>

              Upc</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Cost</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $p=0; @endphp
          @foreach($product as $row)
          @php $p++; @endphp
          <tr>
              <th scope="row" class="text-center"> <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check[]" value="{{$row->id}}">
              </div>
            </th>
            <th>{{$row->upc}}</th>
            <td>@if($row->name !=null) <span  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="{{$row->name}}">{{ Illuminate\Support\Str::limit($row->name, 100,  $end='...')}}</span>@endif</td>
            <td>@if($row->description !=null) <span  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="{{$row->description}}">{{ Illuminate\Support\Str::limit($row->description, 100,  $end='...')}}</span>@endif</td>
            <td><input type="number" class="cost" name="cost" pro_id="{{$row->id}}" value="{{$row->cost}}"/></td>
            <td><input type="number" class="price" pro_id="{{$row->id}}" name="price" value="{{$row->price}}"/></td>
            <td>{{$row->qty}}</td>
            <td><img src="{{$row->image}}" style="max-width: 80px;max-height: 80px;" /></td>
            <td style="width: 174px;">
              <a href="{{url('show_box/?id=' .$row->id)}}" target="_blank">
                <button type="button" class="btn btn-success" ><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                <button type="button" class="btn btn-success edit_product" val="{{$row->id}}" ><i class="fas fa-edit" aria-hidden="true"></i></button>
                @if( auth()->user()->role== 'superadmin')
                  <button type="button" class="btn btn-danger del_box" data-bs-toggle="modal" data-bs-target="#del_product{{$p}}"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                @endif


            </td>
          </tr>
        </form>
          <div class="modal fade" id="del_product{{$p}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <form class="row g-3" style="color: #000;" method="post" action="{{url('update_qty')}}">
                    @csrf

                    <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
                      <div class="col-12">
                        <label for="product_name" class="form-label">Enter Quantity</label>
                        <input type="hidden" name="id" value="{{$row->id}}" />
                        <input type="number" name="Quantity" class="form-control" id="product_name" max="{{$row->qty}}" required>
                        <div class="invalid-feedback">Please, enter product name!</div>
                      </div>

                    </div>

                    <div class="col-12 my-2 text-center">
                      <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit" onclick="alert('Are You Sure');">Remove</button>
                      <button class="btn btn-primary mt-3 eb-user-form-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          @endforeach

        </tbody>
      </table>
      <!-- End Large Modal-->
    </div>
  </section>

</main><!-- End #main -->
@include('../layout/edit_model')
<div class="modal fade" id="import_product" tabindex="-1">
  <div class="modal-dialog eb-modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form class="row g-3" style="color: #000;" method="post" enctype="multipart/form-data" action="{{url('import_product')}}">
          @csrf

          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
            <div class="col-12">
              <label for="product_name" class="form-label">Select File</label>
              <input type="file" name="file" class="form-control" id="product_name" required>
              <label for="product_name" class="form-label"><a href="{{asset('sample.csv')}}" dwonload>Dwonload Sample File</a></label>
            </div>

          </div>

          <div class="col-12 my-2 text-center">
            <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit" onclick="alert('Are You Sure');">Import</button>
            <button class="btn btn-primary mt-3 eb-user-form-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){

  $(document).on('click', '.product_filter', function() {
  var id=$(this).val();
  $.ajax({
        type: 'get',
        url: "{{ url('/filter_product') }}",
        data: {
            'id': id
        },
        success: function(response) {
          $(".append_product").empty().append(response);
        }
    });

  });
  $(document).on('click', '.product_wharehouse', function() {
  var id=$(this).val();
  $.ajax({
        type: 'get',
        url: "{{ url('/filter_product_wharehouse') }}",
        data: {
            'id': id
        },
        success: function(response) {
          $(".append_product").empty().append(response);
        }
    });

  });



  $(document).on('click', '.edit_product', function() {



    var id=$(this).attr('val');





    $.ajax({
        type: 'get',
        url: "{{ url('/edit_product') }}",
        data: {
            'id': id
        },
        success: function(response) {
            $(".edit_body").empty().append(response);

            $("#edit_product").modal('show');
        }
    });

  });

  $(document).on('change', '.change_cat', function() {



    var id=$(this).val();
    $(this).closest('.next_child').nextAll().remove();





    $.ajax({
        type: 'get',
        url: "{{ url('/get_cat') }}",
        data: {
            'id': id
        },
        success: function(response) {

            $('.append_cat').append(response);



        }
    });

  });
  $(document).on('click', '.del_image_remove', function() {



    var id=$(this).attr('get_id');
    var cuurrent=$(this);





    $.ajax({
        type: 'get',
        url: "{{ url('/product_image_remove') }}",
        data: {
            'id': id
        },
        success: function(response) {
          if(response==200)
          {
            $(cuurrent).closest('.col-md-4').remove();

          }





        }
    });

  });
  $(document).on('keyup','.cost', function(e) {



    var cost=$(this).val();
    var id=$(this).attr('pro_id');
    $.ajax({
        type: 'get',
        url: "{{ url('/update_cost') }}",
        data: {
            'cost':cost,'id':id
        },
        success: function(response) {
          if(response==200)
          {
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("Product Cost Update");
          }

        }
    });

  });
  $(document).on('keyup','.price', function(e) {



    var cost=$(this).val();
    var id=$(this).attr('pro_id');
    $.ajax({
        type: 'get',
        url: "{{ url('/update_price') }}",
        data: {
            'price':cost,'id':id
        },
        success: function(response) {
          if(response==200)
          {
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("Product Price Update");
          }

        }
    });
  });  
  $(".checkAll").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
  });


});
$(".js-example").select2({
    tags: true,
    tokenSeparators: [',']
})
const tx = document.getElementsByTagName("textarea");
for (let i = 0; i < tx.length; i++) {
  tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
  tx[i].addEventListener("input", OnInput, false);
}

function OnInput() {
  this.style.height = 0;
  this.style.height = (this.scrollHeight) + "px";
}
</script>


@endsection
