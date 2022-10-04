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

              <option selected>Select Box</option>
              <?php foreach ($Box as $key => $value): ?>
                <option value="{{$value->id}}">{{$value->name}}</option>

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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalBarcode"><i class="fa fa-barcode"></i></button>
                      </span>
                      <input class="form-control eb-barcode-input get_bar_code" id="imei" placeholder="Enter Product name / SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off">
                      <span class="input-group-btn ms-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
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
                      <tbody class=tbody>


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
          <button class="btn btn-primary eb-user-form-btn" type="button">Save</button>
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


<script>

$(document).ready(function(){



      $(document).on('keypress', function(e) {


        if(e.which == 13) {
          var bar_code=$('.get_bar_code').val();
          if($(".tr").hasClass(bar_code))
          {

          }
          else{
            $(".tbody").append(`<tr class="tr ${bar_code}">
              <td>${bar_code}</td>
              <td class="name"><div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                  </div>

              </td>
              <td class="qty"><div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                  </div>
              </td>
              <td></td>
              <td></td>

              </tr>`);




            $.ajax({
                type: 'get',
                url: "{{ url('/search_product') }}",
                data: {
                    'bar_code':bar_code
                },
                success: function(response) {
                  if(response.status ==true)
                  {
                    $("."+bar_code).children(".name").empty().append(response.product.title);
                    $("."+bar_code).children(".qty").empty().append(1);


                  }
                  else{
                    alert(response.msg);
                  }


                }
            });
          }


        }


      });
});
</script>


@endsection
