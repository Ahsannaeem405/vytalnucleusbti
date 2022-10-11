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

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_product{{$p}}"><i class="fas fa-edit" aria-hidden="true"></i></button>
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
          <div class="modal fade" id="edit_product{{$p}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <form class="row g-3" style="color: #000;" method="post" action="{{url('update_qty')}}">
                    @csrf

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
                              <div class="col-md-2">
                                <img src="{{$row->image}}" style="width:100%" />

                              </div>
                              <div class="col-10">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>

                            </div>
                            <div class="row pt-5">

                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Quantity</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Price</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Cost</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Upc</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                            </div>
                            <div class="row pt-4">
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Reserved Quantity</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Variant/Color</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">SKU</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>
                              <div class="col-md-3">
                                <label for="product_name" class="form-label">Uploaded</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                              </div>

                            </div>
                            <div class="row pt-4">
                              <div class="col-md-6">
                                <label for="product_name" class="form-label">Categories</label></label>
                                <div class="row">
                                  <div class="col-md-12 mb-2">
                                    <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                                  </div>
                                  <div class="col-md-12 mb-2">
                                    <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                                  </div>
                                  <div class="col-md-12 mb-2">
                                    <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">
                                  </div>


                                </div>


                              </div>
                              <div class="col-md-6 mt-2">
                                <i class="fa fa-eye" aria-hidden="true"></i><label for="product_name" class="form-label">View Inventory Locations</label>

                              </div>


                            </div>
                            <div class="row pt-4">
                              <div class="col-md-12">
                                <label for="product_name" class="form-label">Tags</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">



                              </div>

                            </div>
                            <div class="row pt-4">
                              <div class="col-md-12">
                                <label for="product_name" class="form-label">Add Memo</label>
                                <input type="text" name="name" class="form-control" id="product_name" required="" value="{{$row->name}}">





                              </div>
                            </div>
                          </div>

                    			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    				<p><strong>This is some placeholder content the Profile tab's associated content.</strong>
                    					Clicking another tab will toggle the visibility of this one for the next.
                    					The tab JavaScript swaps classes to control the content visibility and styling. You can use it with
                    					tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                    			</div>
                    			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    				<p><strong>This is some placeholder content the Contact tab's associated content.</strong>
                    					Clicking another tab will toggle the visibility of this one for the next.
                    					The tab JavaScript swaps classes to control the content visibility and styling. You can use it with
                    					tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                    			</div>
                    		</div>
                    	</div>

                    </div>

                    <div class="col-12 my-2 text-center">
                      <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit" onclick="alert('Are You Sure');">Update</button>
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
@endsection
