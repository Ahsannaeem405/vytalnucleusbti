<div class="modal fade" id="remove_product" tabindex="-1">
  <div class="modal-dialog eb-modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">

          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
            <div class="col-md-12" style="display: flex;justify-content: center;">
              <img src="" class="remove_img" style="max-width: 80px;max-height: 80px;"/>

            </div>
          </div>

          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">

            <div class="col-12">

              <input type="text" name="Quantity" class="form-control product_remove" id="product_name">
            </div>
          </div>
          <div class="col-12 eb-user-form-wrp d-flex gap-2 mt-4">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-condensed table-bordered table-responsive" id="pos_table">
                  <thead>
                    <tr>
                      <th class="text-center">UPC</th>
                      <th class="text-center">Quantity</th>
                    </tr>
                  </thead>
                  <tbody class="append_remove_product">


                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <div class="col-12 my-2 text-center">
            <button class="btn btn-primary mt-3 eb-user-form-btn remove_product" type="button" onclick="alert('Are You Sure');">Remove</button>
            <button class="btn btn-primary mt-3 eb-user-form-btn" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>

      </div>
    </div>
  </div>
</div>
