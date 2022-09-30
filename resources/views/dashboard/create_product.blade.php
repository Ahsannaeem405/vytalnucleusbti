@extends('../layout/main')

@section('create_product')
side_bar_active
@endsection
@section('body_content')
<link rel="stylesheet" href="{{asset('bulma.min.css')}}">
<style>
#qr-reader #qr-reader__dashboard #qr-reader__dashboard_section div #qr-reader__dashboard_section_csr div button {
  color: #fff;
  background-color: #0069d9;
  border-color: #0062cc;
  border-radius: 5px;
}
#qr-reader #qr-reader__dashboard #qr-reader__dashboard_section div #qr-reader__dashboard_section_swaplink {
  display:none;

}


/* #qr-reader div span {
  display:none;
} */
#qr-reader__camera_selection {
  display:none;
}

#qr-reader__dashboard_section_csr span:first-child {
  display:none;

}


#qr-reader__dashboard_section_csr span:last-child button:first-child {
  display:none;

}




#qr-reader div:first-child span:first-child {
  display:none !important;

}

#qr-reader__status_span {
  display:none !important;
}

#qr-reader__dashboard_section_csr button {
  color: #fff;
  background-color: #0069d9;
  border-color: #0062cc;
  border-radius: 5px;
}

#qr-reader__dashboard_section_swaplink {
  display:none !important;
}

#qr-reader {
  border:none !important;
}

  .signRow {
  background: none !important;
  padding: 20px;
  margin-top: 40px;
  margin-bottom: 40px;
}
canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
  @media screen and (max-width: 990px) {
    .navbar-toggler{
        display:none!important;

    }
    .logout2 {
        display:block!important;
    }
    .logo1 {

        font-size: 20px!important;
    }
    .pageslider {
        display:block!important;
    }
}

#qr-shaded-region{
  border-style:unset!important;

}

</style>
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
      <form class="g-3 eb-pro-dtl" novalidate style="color: #000;">

        <!-- product info -->

        <div class="row eb-pro-dtl-info eb-pro-dtl-wrp mb-5">
          <div class="col-md-3 eb-ware-house-prnt">
            <label for="ware_house" class="form-label">Warehouse</label>
            <input type="text" name="name" class="form-control" id="ware_house">
            <span class="input-group-btn Warehouse-modal">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalWarehouse"><i class="fas fa-plus" aria-hidden="true"></i></button>
            </span>
          </div>
          <div class="col-md-3 col-6">
            <label for="product_sku" class="form-label">Level</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>1</option>
              <option value="1">2</option>
              <option value="2">3</option>
            </select>
          </div>
          <div class="col-md-3 col-6">
            <label for="product_sku" class="form-label">Bins</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>A</option>
              <option value="1">B</option>
              <option value="2">C</option>
            </select>
          </div>
          <div class="col-md-3 col-6">
            <label for="product_sku" class="form-label">Row</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>7</option>
              <option value="1">8</option>
              <option value="2">9</option>
            </select>
          </div>
          <div class="col-md-3 col-6">
            <label for="product_sku" class="form-label">Box Name</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>box name</option>
              <option value="1">box name</option>
              <option value="2">box name</option>
            </select>
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
                      <input class="form-control eb-barcode-input" id="imei" placeholder="Enter Product name / SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off">
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
                          <th class="text-center">Product</th>
                          <th class="text-center">Quantity</th>
                          <th class="text-center">Unit Price</th>
                          <th class="text-center">Discount</th>
                          <th class="text-center">Subtotal</th>
                          <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">Product Name</td>
                          <td class="text-center">50</td>
                          <td class="text-center">$10</td>
                          <td class="text-center">2%</td>
                          <td class="text-center">$10</td>
                        </tr>
                        <tr>
                          <td class="text-center">Product Name</td>
                          <td class="text-center">50</td>
                          <td class="text-center">$10</td>
                          <td class="text-center">2%</td>
                          <td class="text-center">$10</td>
                        </tr>
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
          <button class="btn btn-primary eb-user-form-btn" type="submit">Save</button>
        </div>
      </form>
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



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

<script>

 function onScanSuccess(decodedText, decodedResult) {

   console.log(`Code scanned = ${decodedText}`, decodedResult);

   document.getElementById("imei").value = '';
   document.getElementById("imei").value = decodedText;
   alert('Barcode is scanned successfully');
   $("#qr-reader__dashboard_section_csr span:nth-child(2) button:nth-child(2)").click();




}
var html5QrcodeScanner = new Html5QrcodeScanner(
 "qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);













</script>



<script>
$(document).ready(function() {


 $("div#qr-reader__dashboard_section_csr > div button").click(function(){



   setTimeout(function() {

 var length = $('#qr-reader__camera_selection  option').length;
 // alert(length);
 if(length > 1)
 {
   $("#qr-reader__camera_selection option:last").attr("selected", "selected");
 }


 $("div#qr-reader__dashboard_section_csr span:last-child button:first-child").css('display', 'block').css('margin',' auto');

 // alert(length);


 }, 4000);
 });



 $(document).on('click', '.crosbtn', function () {
   var imeino = $(this).attr('iemeno');
   $( "."+imeino ).remove();

   // $(event.target).remove()
 });


 $(document).on('click', '.open_cam', function () {
 $("#qr-reader__dashboard_section_csr > div button").click();
 $("#qr-reader__dashboard_section_csr span:nth-child(2) button:nth-child(2)").click();




});













});
</script>

@endsection
