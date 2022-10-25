@extends('../layout/main')

@section('create_product')
side_bar_active
@endsection
@section('body_content')
<style>
.table-striped>tbody>tr:nth-of-type(odd)>* {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: white;
}
.spinner {

  text-align: center;
}

.spinner > div {
  width: 18px;
  height: 18px;
  background-color: #333;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% {
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
}
.select2 {
  width: 100%!important;
}
</style>
<div class="ajax-loader">
  <img src="{{ url('img/loader.gif') }}" class="img-responsive" />
</div>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Create Product</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->
  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <div class="g-3 eb-pro-dtl"  style="color: #000;">

        <!-- product info -->

        <div class="row eb-pro-dtl-info eb-pro-dtl-wrp mb-5">

          <div class="col-md-3">
            <label for="product_sku" class="form-label">Select Box</label>
            <select class="form-select change_box" aria-label="Default  select example">

              <option value="" selected>Select Box</option>
              <?php foreach ($Box as $key => $value): ?>
                <option value="{{$value->name}}">{{$value->name}}</option>

              <?php endforeach; ?>

            </select>
          </div>
          <div class="append_bar_code col-md-12">

          </div>

        </div>

        <!-- product detailing -->
        <div class="row eb-pro-details eb-pro-dtl-wrp mb-5">
            <div class="box-body ">
                <div class="mt-2 mb-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-btn me-3">
                        <button type="button" class="btn btn-primary" ><i class="fa fa-barcode"></i></button>
                      </span>
                      <input class="form-control eb-barcode-input get_bar_code" id="imei" placeholder="Enter Product name / SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off">
                      <span class="input-group-btn ms-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_product"><i class="fas fa-plus"></i></button>
                      </span>
                      <span class="input-group-btn ms-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#remove_product"><i class="fas fa-minus"></i></button>
                      </span>
                    </div>
                  </div>
                </div>


                           <div class="col-md-12">
                             <div id="qr-reader" style="margin: auto;"></div><hr>
                             </div>
                         </div>

                <div class="pos_product_div">
                  <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                      <thead>
                        <tr>
                          <th class="text-center">UPC</th>
                          <th class="text-center">Product Title</th>
                          <th class="text-center">Quantity</th>
                          <th class="text-center">Image</th>
                          <th class="text-center">Action</th>

                        </tr>
                      </thead>
                      <tbody class="tbody append_product">


                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                      <tbody>
                        <tr>
                         <td>
                            <div class="pull-right">
                            <b>Items:</b>
                            <span class="total_quantity">0.00</span>
                            <b class="ms-2">Total: </b>
                              <span class="price_total">0.00</span>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>


        <!-- product button -->
        <div class="row eb-pro-btn">
          {{-- <button class="btn btn-primary eb-user-form-btn save_product" type="button">Save</button> --}}
        </div>
      </div>
    </div>
  </section>

  <section class="eb-pro-dtl">
    <!-- modal create product -->
    <div class="modal fade" id="largeModal" tabindex="-1">
      <div class="modal-dialog eb-modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate style="color: #000;">
              <div class="col-12 eb-user-form-wrp d-flex gap-2">
                <div class="col-12 text-center">
                  <div class="modal-img-wrp">
                    <img src="assets/img/product1.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="col-12 eb-user-form-wrp d-flex gap-2">
                <div class="col-6">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" name="name" class="form-control" id="product_name" required>
                  <div class="invalid-feedback">Please, enter product name!</div>
                </div>
                <div class="col-6">
                  <label for="product_sku" class="form-label">Product SKU</label>
                  <input type="text" name="name" class="form-control" id="product_sku" required>
                  <div class="invalid-feedback">Please, enter product sku!</div>
                </div>
              </div>
              <div class="col-12 eb-user-form-wrp d-flex gap-2">
                <div class="col-6">
                  <label for="product_salePrice" class="form-label">Sale Price</label>
                  <input type="text" name="name" class="form-control" id="product_salePrice" required>
                </div>
                <div class="col-6">
                  <label for="product_costPrice" class="form-label">Cost Price</label>
                  <input type="text" name="name" class="form-control" id="product_costPrice" required>
                  <div class="invalid-feedback">Please, enter product sku!</div>
                </div>
              </div>
              <div class="col-12 eb-user-form-wrp d-flex gap-2">
                <div class="col-6">
                  <label for="product_cat" class="form-label">Category</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Cat 1</option>
                    <option value="1">Cat 2</option>
                    <option value="2">Cat 3</option>
                  </select>
                </div>
                <div class="col-6">
                  <label for="product_upc" class="form-label">UPC</label>
                  <input type="text" name="name" class="form-control" id="product_upc" required>
                  <div class="invalid-feedback">Please, enter product sku!</div>
                </div>
              </div>
              <div class="col-12 eb-user-form-wrp d-flex gap-2">
                <div class="col-6">
                  <label for="product_quantity" class="form-label">Available Quantity</label>
                  <input type="text" name="name" class="form-control" id="product_quantity" required>
                </div>
                <div class="col-6">
                  <label for="product_res_quantity" class="form-label">Reserved Quantity</label>
                  <input type="text" name="name" class="form-control" id="product_res_quantity" required>
                  <div class="invalid-feedback">Please, enter product sku!</div>
                </div>
              </div>
              <div class="col-12 my-2 text-center">
                <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit">Add Product</button>
                <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal bar code -->
    <div class="modal fade" id="largeModalBarcode" tabindex="-1">
      <div class="modal-dialog eb-modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Product name
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  SKU
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  Lot Number
                </label>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- warehouse modal -->
    <div class="modal fade" id="largeModalWarehouse" tabindex="-1">
      <div class="modal-dialog eb-modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="" class="form-label">Select Warehouse</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Warehouse 1</option>
                    <option value="1">Warehouse 2</option>
                    <option value="2">Warehouse 3</option>
                  </select>
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </section>

</main>

@include('../layout/delete_model')
@include('../layout/move_model')
@include('../layout/remove_product')
@include('../layout/add_product')
@include('../layout/edit_model')


<script>

$(document).ready(function(){



      $(document).on('click','.del_product', function() {
        var qty=$(this).attr('qty');
        var upc=$(this).attr('upc');

        $(".product_utc").val(upc);
        $(".product_qty").attr('max',qty);


        $("#delete_product").modal('show');

      });
      $(document).on('click','.move', function() {
        $(".tranfer_box").empty();


        var qty=$(this).attr('qty');
        var upc=$(this).attr('upc');

        $(".product_move_id").val(upc);
        $(".product_move_qty").attr('max',qty);
        $('.change_box option:not(:selected)').each( function(){
          var opt=$(this).val();
          if(opt.length !=0)
          {
            $(".tranfer_box").append(`<option>${opt}</option>`);
          }
        });



        $("#move_product").modal('show');

      });

      $(document).on('click','.del_product_confirm', function() {
        var qty=$('.product_qty').val();
        var avail_qty=$('.product_qty').attr('max');
        var utc=$('.product_utc').val();
        var box_id=$('.change_box').val();
        if(qty.length !=0)
        {


          if(parseInt(qty) <= parseInt(avail_qty))
          {
            $.ajax({
                type: 'get',
                url: "{{ url('/update_qty_ajax') }}",
                data: {
                    'qty':qty,'utc':utc,'box_id':box_id
                },
                success: function(response) {
                  if(response.status==0)
                  {
                    $("#delete_product").modal('hide');
                    $("."+response.upc).remove();

                  }
                  else{
                    $("."+response.upc).children(".qty").empty().append(response.status);
                    $("."+response.upc).children(".qty").val(response.status);
                    $("."+response.upc).find(".del_product").attr('qty',response.status);
                      $("#delete_product").modal('hide');

                  }
                  sum();

                }
            });
          }
          else{
            alert('Please select quantity less then or equal to'+avail_qty);
          }
        }



      });

      $(document).on('keydown','.product_remove', function(e) {


        if(e.which == 13) {
          var bar_code=$(this).val();
          var img=$("."+bar_code).find(".pro_img").attr('src');
          $(".remove_img").attr('src',img);


          if($(".tr").hasClass(bar_code))
          {
            if($(".trr").hasClass('remove'+bar_code))
            {
              var qty=$(".remove"+bar_code).children(".qty").val();
              var old_qty=$('.'+bar_code).children(".qty").val();
              qty++;

              if(parseInt(qty) <= parseInt(old_qty) )
              {


                $(".remove"+bar_code).children(".qty").empty().append(qty);
                $(".remove"+bar_code).children(".qty").val(qty);

              }
              else{
                --qty;
                alert("You can't scan this item more than "+qty+" times");

              }




            }
            else{
              $(".append_remove_product").prepend(`<tr class="trr remove${bar_code}">
                <td>${bar_code}</td>
                <input type="hidden" name="id" class="upc_id" value="0" />
                <input type="hidden" name="upc" class="remove_upc_val" value="${bar_code}" />

                <input type="hidden" class="qty remove_qty_val" name="qty" value="1" />
                <td class="qty">1

                </td>


                </tr>`);
            }


          }


        }
      });
      $(document).on('click','.remove_product', function() {
        const qty = [];

        $('.remove_qty_val').each(function() {
          qty.push($(this).val());

        });
        const upc = [];

        $('.remove_upc_val').each(function() {
          upc.push($(this).val());

        });
        var box_id=$('.change_box').val();
        const id=[];
        $('.upc_id').each(function() {
          id.push($(this).val());

        });

        var box_id=$('.change_box').val();
        if(box_id.length !=0)
        {
          $.ajax({
              type: 'get',
              url: "{{ url('/remove_inventory_product') }}",
              data: {
                  'box_id':box_id,'upc':upc,'qty':qty,'id':id
              },
              success: function(response) {
                if(response==200)
                {
                  toastr.options = {
                      "closeButton": true,
                      "progressBar": true
                  }
                  toastr.success("Product successfully add");
                  window.location.reload(true);
                }

              }
          });
          sum();

        }
        else {
          alert('Please select the box')
        }




      });

      $(document).on('keydown','.get_bar_code', function(e) {


        if(e.which == 13) {

          var bar_code=$('.get_bar_code').val();
          var box_id=$('.change_box').val();
          // alert(box_id);
          if(box_id !="")
          {

          if($(".tr").hasClass(bar_code))
          {
            var qty=$("."+bar_code).children(".qty").val();
            qty++;

                  $("."+bar_code).children(".qty").empty().append(qty);
                  $("."+bar_code).children(".qty").val(qty);
                  $("."+bar_code).find(".del_product").attr('qty',qty);
                  $("."+bar_code).find(".move").attr('qty',qty);


                  $.ajax({
                    type: 'get',
                    url: "{{ url('/update_old_product') }}",
                    data: {
                        'bar_code':bar_code,'box_id':box_id
                    },
                    success: function(response) {
                      
                    }
                });






          }
          else{
            $(".tbody").prepend(`<tr class="tr ${bar_code}">
              <td>${bar_code}</td>
              <input type="hidden" name="id" class="upc_id" value="0" />
              <input type="hidden" name="upc" class="upc_val" value="${bar_code}" />
              <td class="name">


              </td>
              <input type="hidden" class="qty qty_val" name="qty" value="1" />
              <td class="qty">1

              </td>
              <td class="img"></td>
              <td class="text-center ">
                <button type="button" class="btn btn-success edit_product new" val="${bar_code}"><i class="fas fa-edit" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-danger  del_product" upc="${bar_code}" qty="1"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                <button="" type="button" class="btn btn-success move" upc="0" qty="1"><img src="{{asset('move.png')}}"  style="width:20px;"/></button>

              </td>

              </tr>`);




            $.ajax({
                type: 'get',
                url: "{{ url('/search_product') }}",
                data: {
                    'bar_code':bar_code,'box_id':box_id
                },
                success: function(response) {
                  if(response.status==1)
                  {
                    $("."+bar_code).children(".name").empty().append(response.product['name']);
                    $("."+bar_code).children(".img").empty().append(`<img src="${response.product['image']}" style="width: 60px;" />`);
                  }
                }
            });


          }
          sum();

        }else{
            alert('please select a box');
          }


        }



      });
      $(document).on('change', '.change_box', function() {

        var box_id=$('.change_box').val();
        $('.append_product').empty();

        $.ajax({
            type: 'get',
            url: "{{ url('/get_product') }}",
            data: {
                'id': box_id
            },
            success: function(response) {
              $('.append_product').append(response);

              sum();

            }
        });

      });

      $(document).on('click','.save_product', function() {
        const qty = [];

        $('.qty_val').each(function() {
          qty.push($(this).val());

        });
        const new_upc = [];
        console.log(new_upc);
        $('.upc_val').each(function() {


          new_upc.push($(this).val());


        });
        console.log(new_upc);
        var box_id=$('.change_box').val();
        const id=[];
        $('.upc_id').each(function() {
          id.push($(this).val());

        });


        var box_id=$('.change_box').val();
        if(box_id.length !=0)
        {
          $.ajax({
              type: 'get',
              url: "{{ url('/add_inventory_product') }}",
              data: {
                  'box_id':box_id,'upc':new_upc,'qty':qty,'id':id
              },
              success: function(response) {
                if(response==200)
                {
                  toastr.options = {
                      "closeButton": true,
                      "progressBar": true
                  }
                  toastr.success("Product successfully add");
                  window.location.reload(true);
                }

              }
          });
          sum();

        }
        else {
          alert('Please select the box')
        }




      });


});
function sum(){
  var sum = 0;
  var i=0;
  $('.qty_val').each(function() {
    i++;
      sum += Number($(this).val());
  });
  $('.price_total').empty().append(sum);
  $('.total_quantity').empty().append(i);
}
</script>
<script>
$(document).ready(function(){

  $(document).on('click', '.edit_product', function() {



    var id=$(this).attr('val');





    if($('.edit_product').hasClass('new'))
    {
      $.ajax({
          type: 'get',
          url: "{{ url('/edit_new_product') }}",
          data: {
              'id': id
          },
          success: function(response) {
              $(".edit_body").empty().append(response);

              $("#edit_product").modal('show');
          }
      });

    }
    else{
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

    }


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
  $(document).on('click', '.save_click', function() {



    var box_id=$('.change_box').val();
    if(box_id.length !=0)
    {
          $('.append_box_id').val(box_id);
          $(".save_submit").click();
    }
    else {
      alert('Please select the box')
    }

  });
  $(document).on('click', '.print_click', function() {



    var box_id=$('.change_box').val();
    if(box_id.length !=0)
    {
          $('.append_box_id').val(box_id);
          $('.print').val('print');
          $(".save_submit").click();
    }
    else {
      alert('Please select the box')
    }

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
