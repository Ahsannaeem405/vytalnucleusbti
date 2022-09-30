@extends('../layout/main')

@section('create_product')
side_bar_active
@endsection
@section('body_content')
<link rel="stylesheet" href="{{asset('bulma.min.css')}}">

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
        <div class="row d-flex">

                   <div class="col-md-6">
                     <div id="qr-reader" style="margin: auto;"></div>










                       <p class="my-2 my-md-3 text-"> <strong> Click to scan barcode</strong></p>


                       {{-- <p id="para">Having problem while scaning barcode?</p> --}}

                     <hr>
                     </div>

                   <div class="col-md-6 m-auto">

                       <i class="fas fa-camera open_cam" style="font-size: 40px;"></i>

                       <section class="section section_came" id="section_cameye" style="display:none;">
                         <div class="container">
                           <div class="columns">
                             <div class="column is-four-fifths">

                               <video autoplay id="video"></video>
                               <button type="button" class="button is-hidden" id="btnPlay">
                                 <span class="icon is-small">
                                   <i class="fas fa-play"></i>
                                 </span>
                               </button>
                               <button type="button" class="button" id="btnPause">
                                 <span class="icon is-small">
                                   <i class="fas fa-pause"></i>
                                 </span>
                               </button>
                               <button type="button" class="button is-success" id="btnScreenshot">
                                 <span class="icon is-small">
                                   <i class="fas fa-camera"></i>
                                 </span>
                               </button>
                               <button type="button" class="button d-none" id="btnChangeCamera">
                                 <span class="icon">
                                   <i class="fas fa-sync-alt"></i>
                                 </span>
                                 <span>Switch camera</span>
                               </button>
                             </div>
                             <div class="column d-none" >

                               <div id="screenshots"></div>
                             </div>
                           </div>
                         </div>
                       </section>

                       <canvas class="is-hidden" id="canvas"></canvas>
                       <input type="file" name="file" class="scan_img d-none" id="imgInp" onchange="encodeImageFileAsURL(this)">
                       <img src="https://i0.wp.com/css-tricks.com/wp-content/uploads/2015/11/drag-drop-upload-6.gif" class="scan_img2" id="blah">
                       <input type="hidden" name="scam_so" id="scan_img3">
                         <button type="button" id="form"
                         > Upload </button>

                   </div>
                 </div>

        <div class="row eb-pro-dtl-info eb-pro-dtl-wrp mb-5">
          <div class="col-3 eb-ware-house-prnt">
            <label for="ware_house" class="form-label">Warehouse</label>
            <input type="text" name="name" class="form-control" id="ware_house">
            <span class="input-group-btn Warehouse-modal">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModalWarehouse"><i class="fas fa-plus" aria-hidden="true"></i></button>
            </span>
          </div>
          <div class="col-3">
            <label for="product_sku" class="form-label">Level</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>1</option>
              <option value="1">2</option>
              <option value="2">3</option>
            </select>
          </div>
          <div class="col-3">
            <label for="product_sku" class="form-label">Bins</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>A</option>
              <option value="1">B</option>
              <option value="2">C</option>
            </select>
          </div>
          <div class="col-3">
            <label for="product_sku" class="form-label">Row</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>7</option>
              <option value="1">8</option>
              <option value="2">9</option>
            </select>
          </div>
          <div class="col-3">
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
                      <input class="form-control eb-barcode-input" id="search_product" placeholder="Enter Product name / SKU / Scan bar code" autofocus="" name="search_product" type="text" autocomplete="off">
                      <span class="input-group-btn ms-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
                      </span>
                    </div>
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
<script>
 $(document).ready(function(){

   $("p#para").click(function(){
     $("#imeidiv").css("display", "block");

   });




   $("#toggleBtn").click(function(){


     if($(this).attr("stat") == "1")
     {
       $("#tablesection").css("display", "block");
       $("#formsection").css("display", "none");
       $(this).attr("stat","2");

     }
     else{
       alert('kdjf');
     }

   });




 });
 </script>



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










$("#barcodefield").click(function(){


 var vali = $("#imei").val();
   var optselect = $('#mobile').val();
   if(optselect != 'select your mobile')
   {
       if(vali != '')
       {
         $(".loader").css("display", "block");


       $.ajax({
           method: 'GET',
           url: "{{url('imeidetail')}}",
           data: {imeino: vali, serviceid: optselect},
           success: function( response ){
             $(".loader").css("display", "none");
             if(response == 'low balance or wronge imei No')
             {
               var html=`<tr class="` + vali + `">
                 <td> `+ vali + `</td>
                 <td> rejected </td>
                 <td><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x crosbtn" viewBox="0 0 16 16" iemeno="` + vali + `">
                 <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                 </svg>
                 </td>
                 </tr>`;
               $("#billbutton").attr("disabled", false);
               $('#imeitable').append(html);
               $('#imei').val('');



               $("<input type='hidden' value=" + vali + "/>")
               .attr("class", vali)
               .attr("name", "myfieldid[]")
               .appendTo("#form-0");

               $("<input type='hidden' value='rejected'/>")
               .attr("class", vali)
               .attr("name", "status[]")
               .appendTo("#form-0");
               $("<input type='hidden' value=" + optselect + ">")
               .attr("class", vali)
               .attr("name", "ser_idd[]")
               .appendTo("#form-0");



             }
             if(response == 'wronge imei number')
             {
               var html=`<tr class="` + vali + `">
                 <td> `+ vali + `</td>
                 <td> rejected </td>
                 <td><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x crosbtn" viewBox="0 0 16 16" iemeno="` + vali + `">
                 <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                 </svg>
                 </td>
                 </tr>`;
               alert('wronge imei number');
               $("#billbutton").attr("disabled", false);
               $('#imeitable').append(html);
               $('#imei').val('');


               $("<input type='hidden' value=" + vali + " />")
               .attr("class", vali)
               .attr("name", "myfieldid[]")
               .appendTo("#form-0");
               $("<input type='hidden' value='rejected'/>")
               .attr("class", vali)
               .attr("name", "status[]")
               .appendTo("#form-0");
               $("<input type='hidden' value=" + optselect + ">")
               .attr("class", vali)
               .attr("name", "ser_idd[]")
               .appendTo("#form-0");
             }

               if(response == 'ok')
               {
                 var html=`<tr class="` + vali + `">
                 <td> `+ vali + `</td>
                 <td> verified </td>
                 <td><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x crosbtn" viewBox="0 0 16 16" iemeno="` + vali + `">
                 <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                 </svg>
                 </td>
                 </tr>`;
                 $("#billbutton").removeAttr('disabled');
                 $('#imeitable').append(html);
                   $('#imei').val('');


                 $("<input type='hidden' value=" + vali + " />")
                 .attr("class", vali)
                 .attr("name", "myfieldid[]")
                 .appendTo("#form-0");
                 $("<input type='hidden' value='verified'/>")
                 .attr("class", vali)
                 .attr("name", "status[]")
                 .appendTo("#form-0");
                 $("<input type='hidden' value=" + optselect + ">")
               .attr("class", vali)
               .attr("name", "ser_idd[]")
               .appendTo("#form-0");


               }
           }
       });
     } else {
       alert('Please scan barcode or enter imei number');
     }
   } else {
     alert('please ' + optselect + ' company first');
     $("#imei").val('');
   }



});


</script>



<script>
$(document).ready(function() {


 $("div#qr-reader__dashboard_section_csr > div button").click(function(){

   var x = document.getElementById("section_cameye");
   if (x.style.display === "block") {
     x.style.display = "none";
   }

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

 $(document).on('click', '#qr-reader__dashboard_section_csr span:last-child button:first-child', function () {
  var x = document.getElementById("section_cameye");
   if (x.style.display === "block") {
     x.style.display = "none";
   }
 });
 $(document).on('click', '.open_cam', function () {
 $("#qr-reader__dashboard_section_csr > div button").click();
 $("#qr-reader__dashboard_section_csr span:nth-child(2) button:nth-child(2)").click();


 setTimeout(function() {
   $("#btnChangeCamera").click();

   var x = document.getElementById("section_cameye");
   if (x.style.display === "none") {
     x.style.display = "block";
   } else {
     x.style.display = "none";
   }



 }, 2000);

});

 $(document).on('click', '.sig-submitBtn', function () {
    Swal.fire(
     'Signature Added',

   )
  });
  $(document).on('click', '.scan_img2', function () {
    $(".scan_img").click();
  });
  $("#form").on('click',(function(e) {
  $('.sel_imi').empty();
  e.preventDefault();
  var img=$('#scan_img3').val();
  var _token = $("input[name='_token']").val();
  var op="";
  $.ajax({
  url: '{{URL::to('scan_img')}}',

  type: "POST",
  data: {_token: "{{ csrf_token() }}",'img': img},



   success: function(data)
   {
     for (var i = 0; i < data['msg'].length; i++) {


                                   op +='<option value="">'+data['msg'][i]+'</option>';


     }
      $('.sel_imi').append( '<label for="">Please Select Company:</label>'+
                         '<select type="text" name="mobcompany" class="form-control" aria-label="Default select example" id="mobile"><option value="">Select An IMEI</option>'+op+'</select>');






   },

 });
}));










});
</script>
<script>


 (function($) {

 $('.signRow').each(function(){



   // make dynamic pad id
   $(this).find('canvas').attr('id', 'signPad' + $(this).index());
   var padId = $(this).find('canvas').attr('id');

   // make dynamic submit BTN id
   $(this).find('.sig-submitBtn').attr('id', 'sig-submitBtn' + $(this).index());
   var padSubmitId = $(this).find('.sig-submitBtn').attr('id');

   // make dynamic clear BTN id
   $(this).find('.sig-clearBtn').attr('id', 'sig-clearBtn' + $(this).index());
   var padClearId = $(this).find('.sig-clearBtn').attr('id');

   // make dynamic data url id
   $(this).find('.sig-dataUrl').attr('id', 'sig-dataUrl' + $(this).index());
   var padDataUrlId = $(this).find('.sig-dataUrl').attr('id');

   // make dynamic img id
   $(this).find('.sig-image').attr('id', 'sig-image' + $(this).index());
   var padImageId = $(this).find('.sig-image').attr('id');


   window.requestAnimFrame = (function (callback) {
     return window.requestAnimationFrame ||
       window.webkitRequestAnimationFrame ||
       window.mozRequestAnimationFrame ||
       window.oRequestAnimationFrame ||
       window.msRequestAnimaitonFrame ||
       function (callback) {
         window.setTimeout(callback, 1000 / 60);
       };
   })();


   var canvas = document.getElementById(padId);
   var ctx = canvas.getContext("2d");
   ctx.strokeStyle = "#222222";
   ctx.lineWidth = 4;

   var drawing = false;
   var mousePos = {
     x: 0,
     y: 0
   };
   var lastPos = mousePos;

   canvas.addEventListener("mousedown", function (e) {
     drawing = true;
     lastPos = getMousePos(canvas, e);
   }, false);

   canvas.addEventListener("mouseup", function (e) {
     drawing = false;
   }, false);

   canvas.addEventListener("mousemove", function (e) {
     mousePos = getMousePos(canvas, e);
   }, false);

   // Add touch event support for mobile
   canvas.addEventListener("touchstart", function (e) {

   }, false);

   canvas.addEventListener("touchmove", function (e) {
     var touch = e.touches[0];
     var me = new MouseEvent("mousemove", {
       clientX: touch.clientX,
       clientY: touch.clientY
     });
     canvas.dispatchEvent(me);
   }, false);

   canvas.addEventListener("touchstart", function (e) {
     mousePos = getTouchPos(canvas, e);
     var touch = e.touches[0];
     var me = new MouseEvent("mousedown", {
       clientX: touch.clientX,
       clientY: touch.clientY
     });
     canvas.dispatchEvent(me);
   }, false);

   canvas.addEventListener("touchend", function (e) {
     var me = new MouseEvent("mouseup", {});
     canvas.dispatchEvent(me);
   }, false);

   function getMousePos(canvasDom, mouseEvent) {
     var rect = canvasDom.getBoundingClientRect();
     return {
       x: mouseEvent.clientX - rect.left,
       y: mouseEvent.clientY - rect.top
     }
   }

   function getTouchPos(canvasDom, touchEvent) {
     var rect = canvasDom.getBoundingClientRect();
     return {
       x: touchEvent.touches[0].clientX - rect.left,
       y: touchEvent.touches[0].clientY - rect.top
     }
   }

   function renderCanvas() {
     if (drawing) {
       ctx.moveTo(lastPos.x, lastPos.y);
       ctx.lineTo(mousePos.x, mousePos.y);
       ctx.stroke();
       lastPos = mousePos;
     }
   }

   // Prevent scrolling when touching the canvas
   document.body.addEventListener("touchstart", function (e) {
     if (e.target == canvas) {
       e.preventDefault();
     }
   }, false);
   document.body.addEventListener("touchend", function (e) {
     if (e.target == canvas) {
       e.preventDefault();
     }
   }, false);
   document.body.addEventListener("touchmove", function (e) {
     if (e.target == canvas) {
       e.preventDefault();
     }
   }, false);

   (function drawLoop() {
     requestAnimFrame(drawLoop);
     renderCanvas();
   })();

   function clearCanvas() {
     canvas.width = canvas.width;
   }

   // Set up the UI
   var sigText = document.getElementById(padDataUrlId);
   var sigImage = document.getElementById(padImageId);
   var clearBtn = document.getElementById(padClearId);
   var submitBtn = document.getElementById(padSubmitId);

   clearBtn.addEventListener("click", function (e) {
     clearCanvas();
     // sigText.innerHTML = "Data URL for your signature will go here!";
     sigImage.setAttribute("src", "");
   }, false);

   submitBtn.addEventListener("click", function (e) {
     var dataUrl = canvas.toDataURL();
     sigText.innerHTML = dataUrl;
     sigImage.setAttribute("src", dataUrl);
   }, false);


 }); // each function  end

})(jQuery);


function encodeImageFileAsURL(element) {

             var file = element.files[0];
             var reader = new FileReader();
             reader.onloadend = function() {
               console.log('RESULT', reader.result);
               $(".scan_img2").attr('src',reader.result);
               $("#scan_img3").val(reader.result);
             }
             reader.readAsDataURL(file);


       }


</script>
@endsection
