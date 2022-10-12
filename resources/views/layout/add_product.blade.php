<div class="modal fade" id="add_product" tabindex="-1">
  <div class="modal-dialog eb-modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body ">
      <head>

      <style>
      .top-right {
        position: absolute;
        top: 8px;
        right: 16px;
      }
      </style>
      </head>
              <form enctype="multipart/form-data" class="row g-3" style="color: #000;" method="post" action="{{url('new_add_product' )}}">
                @csrf
                <input type="hidden" name="box_id" class="append_box_id" />

                <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
                  <div class="p-1" style="width:100%">
                    <nav>
                      <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Listing Details</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Description</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Images</button>
                      </div>
                    </nav>
                    <div class="tab-content p-3 border " id="nav-tabContent">
                      <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="row">

                          <div class="col-12">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" id="product_name" required="" value="">
                          </div>

                        </div>
                        <div class="row pt-5">

                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Quantity</label>
                            <input type="text" name="qty" class="form-control" id="product_name"  value="">
                          </div>
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" id="product_name"  value="">
                          </div>
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Cost</label>
                            <input type="text" name="cost" class="form-control" id="product_name"  value="">
                          </div>
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Upc</label>
                            <input type="text" name="upc" class="form-control" id="product_name" value="">
                          </div>
                        </div>
                        <div class="row pt-4">
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Reserved Quantity</label>
                            <input type="text" name="r_qty" class="form-control" id="product_name" value="">
                          </div>
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Variant/Color</label>
                            <input type="text" name="vc" class="form-control" id="product_name"  value="">
                          </div>
                          @php

                              $rand=rand(1234,5678);

                              $sku="sku".$rand;


                          @endphp

                          <div class="col-md-3">
                            <label for="product_name" class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" id="product_name" value="{{$sku}}" readonly>
                          </div>
                          <div class="col-md-3">
                            <label for="product_name" class="form-label">Uploaded</label>
                            <input type="text" name="name" class="form-control" id="product_name"  value="">
                          </div>

                        </div>
                        <div class="row pt-4">
                          <div class="col-md-6">
                            <label for="product_name" class="form-label">Categories</label></label>
                            <div class="row append_cat">
                              <div class="col-md-12 mb-2 next_child">
                                <select class="form-select  change_cat" name="cat[]">

                                  <?php foreach ($cat as $cat_row): ?>
                                    <option value="{{$cat_row->id}}">
                                      {{$cat_row->title}}
                                    </option>

                                  <?php endforeach; ?>
                                </select>
                              </div>



                            </div>


                          </div>
                          <div class="col-md-6 mt-2">

                          </div>


                        </div>
                        <div class="row pt-4">
                          <div class="col-md-12">
                            <label for="product_name" class="form-label">Tags</label>

                            <select class="form-select js-example" multiple="multiple" required name="tags[]">


                            </select>



                          </div>

                        </div>
                        <div class="row pt-4">
                          <div class="col-md-12">
                            <label for="product_name" class="form-label">Add Memo</label>
                            <input type="text" name="memo" class="form-control" id="product_name"  value="">





                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <textarea class="form-control text_des" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>

                      </div>


                      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="col-md-12">
                          <div class="row pt-4">


                          </div>
                          <div class="row pt-4">
                            <div class="col-md-12">
                              <label for="product_name" class="form-label">Add Images</label>
                              <input type="file" name="file[]" class="form-control" id="product_name" multiple>





                            </div>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-12 my-2 text-center">
                  <button class="btn btn-primary mt-3 eb-user-form-btn save_submit d-none" type="submit" >Update</button>

                  <button class="btn btn-primary mt-3 eb-user-form-btn save_click" type="button" onclick="alert('Are You Sure');">Update</button>
                  <button class="btn btn-primary mt-3 eb-user-form-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
      <script>

      $(document).ready(function(){




        $(".js-example").select2({
            tags: true,
            tokenSeparators: [',']
        })
      });






      </script>

      <script>

      </script>


      </div>
    </div>
  </div>
</div>
