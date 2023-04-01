<div class="modal fade" id="move_product" tabindex="-1">
  <div class="modal-dialog eb-modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form class="row g-3" style="color: #000;" method="post" action="{{url('move_product')}}">
          @csrf
          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
            <div class="col-md-12">
              <label for="product_sku" class="form-label">Select Box</label>
              <select class="form-select tranfer_box" name="box_id" aria-label="Default  select example">




              </select>
            </div>
          </div>

          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">

            <div class="col-12">
              <label for="product_name" class="form-label">Enter Quantity</label>
              <input type="hidden" name="id" class="product_move_id" value="" />
              <input type="number" name="Quantity" class="form-control product_move_qty" id="product_name" max="" required>
              <div class="invalid-feedback">Please, enter product name!</div>
            </div>

          </div>

          <div class="col-12 my-2 text-center">
            <button class="btn btn-primary mt-3 eb-user-form-btn" type="submit" onclick="alert('Are You Sure');">Move</button>
            <button class="btn btn-primary mt-3 eb-user-form-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
