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
      <td>{{$row->cost}}</td>
      <td>{{$row->price}}</td>
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
