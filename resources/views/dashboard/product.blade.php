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
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
        <a type="button" class="btn btn-primary eb-add-data" href="{{url('create_product')}}"><i class="fas fa-plus"></i></a>
        <thead>
          <tr>
            <th scope="col" class="text-center">Upc</th>
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
            <th scope="row" class="text-center">{{$row->upc}}</th>
            <td>@if($row->name !=null) <span  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="{{$row->name}}">{{ Illuminate\Support\Str::limit($row->name, 100,  $end='...')}}</span>@endif</td>
            <td>@if($row->description !=null) <span  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="{{$row->description}}">{{ Illuminate\Support\Str::limit($row->description, 100,  $end='...')}}</span>@endif</td>
            <td></td>
            <td></td>
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

<script>
$(document).ready(function(){


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
