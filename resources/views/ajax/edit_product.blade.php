<head>

<style>
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}
</style>
</head>
        <form enctype="multipart/form-data" class="row g-3" style="color: #000;" method="post" action="{{url('update_product/' .$row->id)}}">
          @csrf

          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
            <div class="p-1" style="width:100%">
              <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home-edit" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Listing Details</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile-edit" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Description</button>
                  <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact-edit" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Images</button>
                </div>
              </nav>
              <div class="tab-content p-3 border " id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home-edit" role="tabpanel" aria-labelledby="nav-home-tab">

                  <div class="row">
                    <div class="col-md-2">
                      @if($row->image != null)
                        <img src="{{$row->image}}" style="width:100%;" />
                      @else
                        @foreach($row->images  as $img)
                            @if($loop->first)
                                <img src="{{asset('upload/images/' .$img->image_id)}}"  style="width:100%;"/>
                            @endif
                        @endforeach
                      @endif

                    </div>
                    <div class="col-10">
                      <label for="product_name" class="form-label">Product Name</label>
                      <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                    </div>

                  </div>
                  <div class="row pt-5">

                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Quantity</label>
                      <input type="text" name="qty" class="form-control" id="product_name"  value="{{$row->qty}}">
                    </div>
                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Price</label>
                      <input type="text" name="price" class="form-control" id="product_name"  value="{{$row->price}}">
                    </div>
                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Cost</label>
                      <input type="text" name="cost" class="form-control" id="product_name"  value="{{$row->cost}}">
                    </div>
                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Upc</label>
                      <input type="text" name="upc" class="form-control" id="product_name" value="{{$row->upc}}">
                    </div>
                  </div>
                  <div class="row pt-4">
                    <div class="col-md-3">
                      <label for="product_name"  class="form-label">Reserved Quantity</label>
                      <input type="text" {{auth()->user()->role != "superadmin" ? 'readonly': ''}}  name="r_qty" class="form-control" id="product_name" value="{{$row->r_qty}}">
                    </div>
                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Variant/Color</label>
                      <input type="text" name="vc" class="form-control" id="product_name"  value="{{$row->vc}}">
                    </div>
                    @php
                      if($row->sku ==null)
                      {
                        $rand=rand(1234,5678);

                        $sku="sku".$rand;
                      }
                      else{
                        $sku=$row->sku;


                      }
                    @endphp

                    <div class="col-md-3">
                      <label for="product_name" class="form-label">SKU</label>
                      <input type="text" name="sku" class="form-control" id="product_name" value="{{$sku}}" readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="product_name" class="form-label">Uploaded</label>
                      <input type="text" readonly class="form-control" id="product_name"  value="{{$row->upload == 1 ? 'Yes': 'No'}}">
                    </div>

                  </div>
                  <div class="row pt-4">
                    <div class="col-md-6">
                      <label for="product_name" class="form-label">Categories</label></label>
                      <div class="row append_cat">
                        @php $back_id=0; @endphp

                        @foreach($row->categories as $cate)


                            @if ($loop->first)
                            <div class="col-md-12 mb-2 next_child">

                              <select class="form-select  change_cat" name="cat[]">

                                    @foreach($cat as $cat_row)


                                        <option value="{{$cat_row->id}}"  @if($cate->cat_id==$cat_row->id) selected @endif>{{$cat_row->title}}
                                        </option>


                                    @endforeach
                                </select>
                            </div>
                            @php

                               $back_id=$cate;

                            @endphp
                            @endif
                        @endforeach
                        @php $ck=0; @endphp

                        @foreach($row->categories as $cate2)


                          @if(!($loop->first))
                          @php $ck++; @endphp
                              <div class="col-md-12 mb-2 next_child">
                                <select class="form-select  change_cat" name="cat[]">

                                      @foreach($back_id->child_categories as $sub_cat)

                                          <option value="{{$sub_cat->id}}"  @if($cate2->cat_id==$sub_cat->id) selected @endif>{{$sub_cat->title}}
                                          </option>
                                      @endforeach

                                  </select>
                              </div>
                              @php
                                $back_id=$cate2;
                            @endphp
                          @endif





                        @endforeach
                        @if(count($row->categories)==0)
                          <div class="col-md-12 mb-2 next_child">
                            <select class="form-select  change_cat" name="cat[]">
                              <option value="">
                              Seelect Category
                              </option>

                              <?php foreach ($cat as $cat_row): ?>
                                <option value="{{$cat_row->id}}">
                                  {{$cat_row->title}}
                                </option>

                              <?php endforeach; ?>
                            </select>
                          </div>

                        @endif




                      </div>


                    </div>
                    <div class="col-md-6 mt-2">
                      <a href="{{url('show_box/?id=' .$row->id)}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a><label for="product_name" class="form-label"><a href="{{url('show_box/?id=' .$row->id)}}" target="_blank">View Inventory Locations</a></label>

                    </div>


                  </div>
                  <div class="row pt-4">
                    <div class="col-md-12">
                      <label for="product_name" class="form-label">Tags</label>
                      @php
                        $tag=explode(',',$row->tag);
                      @endphp
                      <select class="form-select js-example" multiple="multiple"  name="tags[]">

                        <?php foreach ($tag as $key => $value): ?>
                          <option @if ($value !=null) selected @endif>
                            {{$value}}
                          </option>

                        <?php endforeach; ?>
                      </select>



                    </div>

                  </div>
                  <div class="row pt-4">
                    <div class="col-md-12">
                      <label for="product_name" class="form-label">Add Memo</label>
                      <input type="text" name="memo" class="form-control" id="product_name"  value="{{$row->memo}}">





                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-profile-edit" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <textarea class="form-control text_des" id="exampleFormControlTextarea1" name="description" rows="3">{{$row->description}}</textarea>

                </div>


                <div class="tab-pane fade" id="nav-contact-edit" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="col-md-12">
                    <div class="row pt-4">

                      @if($row->image != null)
                        {{-- {{$row->image}} --}}
                        <div class="col-md-4 mb-3" style=" position: relative;text-align: center;color: white;">
                          <img src="{{$row->image}}"  style="width:50%;"/>
                          {{-- <div class="top-right"><i class="far fa-trash-alt del_image_remove" get_id="{{$img->id}}" aria-hidden="true" style="background-image: linear-gradient(90deg, #e52092, #982cba);padding: 10px;border-radius: 50px;"></i></div> --}}


                        </div>
                      
                      @endif

                        @foreach($row->images  as $img)
                        <div class="col-md-4 mb-3" style=" position: relative;text-align: center;color: white;">
                          <img src="{{asset('upload/images/' .$img->image_id)}}"  style="width:100%;"/>
                          <div class="top-right"><i class="far fa-trash-alt del_image_remove" get_id="{{$img->id}}" aria-hidden="true" style="background-image: linear-gradient(90deg, #e52092, #982cba);padding: 10px;border-radius: 50px;"></i></div>







                        </div>
                        @endforeach
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
            <button class="btn btn-primary mt-3 eb-user-form-btn save" type="submit" onclick="alert('Are You Sure');">Update</button>
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
