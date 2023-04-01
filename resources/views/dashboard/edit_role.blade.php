@extends('../layout/main')
@section('roles')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
    </nav>
  </div>

  <!-- End Page Title -->
  <section class="eb-table-wrp mt-5">
    <div class="col-12">
        <form class=""   method="POST" action="{{ url('update_role/' .$role->id) }}" style="color: #000;">
          @csrf
          <div class="mb-3">
            <label for="" class="form-label">Role Name</label>
            <input class="form-control"  name="name" placeholder="Role Name"  value="{{$role->name}}" required>

          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_dashboard">
                Dashboard
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="dashboard" name="permission[]" id="roles_dashboard"  @if(in_array("dashboard_index", $permission)) checked @endif
>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_products">
                Products
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="Products" name="permission[]" id="roles_products" @if(in_array("Products", $permission)) checked @endif>
            </div>
          </div>
          <!-- <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_inventory">
                Inventory
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="Inventory" name="permission[]" id="roles_inventory" @if(in_array("Inventory", $permission)) checked @endif>
            </div>
          </div> -->
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_warehouse">
                Warehouse
              </label>
              <input class="form-check-input form-input-check click_check" child="warehouse"  type="checkbox" value="" id="roles_warehouse" @if(in_array("warehouse", $permission) || in_array("warehouse_update", $permission) || in_array("warehouse_Delete", $permission) || in_array("warehouse_save", $permission)  ) checked @endif >
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse" name="permission[]" @if(in_array("warehouse", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_update" name="permission[]"  id="level_edit" @if(in_array("warehouse_update", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_Delete" name="permission[]" id="level_delete" @if(in_array("warehouse_Delete", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_save" name="permission[]" id="level_create" @if(in_array("warehouse_save", $permission)) checked @endif>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Level
              </label>
              <input class="form-check-input form-input-check click_check" child="level" type="checkbox" value="" id="roles_level" @if(in_array("levels", $permission) || in_array("level_update", $permission) || in_array("level_Delete", $permission) || in_array("level_store", $permission)  ) checked @endif>
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input level" type="checkbox" value="levels"  name="permission[]"  id="level_view" @if(in_array("levels", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_update"  name="permission[]" @if(in_array("level_update", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_Delete" name="permission[]" id="level_delete" @if(in_array("level_Delete", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_store" name="permission[]" id="level_create" @if(in_array("level_store", $permission)) checked @endif>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Bin
              </label>
              <input class="form-check-input form-input-check click_check"  child="bins" type="checkbox" value="" id="roles_level" @if(in_array("bins", $permission) || in_array("bin_update", $permission) || in_array("bin_Delete", $permission) || in_array("bin_save", $permission)  ) checked @endif>
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bins" name="permission[]"  id="level_view" @if(in_array("bins", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_update" name="permission[]" @if(in_array("bin_update", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_Delete" name="permission[]" id="level_delete" @if(in_array("bin_Delete", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_save" name="permission[]" id="level_create" @if(in_array("bin_save", $permission)) checked @endif>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Row
              </label>
              <input class="form-check-input form-input-check click_check"  child="all_row" type="checkbox" value="" id="roles_level"  @if(in_array("rows", $permission) || in_array("row_update", $permission) || in_array("row_Delete", $permission) || in_array("row_save", $permission)  ) checked @endif>
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="rows" name="permission[]" id="level_view"  @if(in_array("rows", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_update" name="permission[]" @if(in_array("row_update", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_Delete" id="level_delete" name="permission[]" @if(in_array("row_Delete", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_save" id="level_create" name="permission[]" @if(in_array("row_save", $permission)) checked @endif>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Inventory
              </label>
              <input class="form-check-input form-input-check click_check"  child="box" type="checkbox" value="" id="roles_level" @if(in_array("Boxes", $permission) || in_array("box_update", $permission) || in_array("box_Delete", $permission) || in_array("box_save", $permission)  ) checked @endif>
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input box" type="checkbox" value="Boxes" id="level_view" name="permission[]" @if(in_array("Boxes", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_update"  name="permission[]" @if(in_array("box_update", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_Delete" id="level_delete" name="permission[]" @if(in_array("box_Delete", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_save" id="level_create" name="permission[]" @if(in_array("box_save", $permission)) checked @endif>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_users">
                Users
              </label>
              <input class="form-check-input form-input-check click_check"  child="users" type="checkbox" value="" id="roles_users" @if(in_array("warehouse", $permission) || in_array("warehouse_update", $permission) || in_array("warehouse_Delete", $permission) || in_array("warehouse_save", $permission)  ) checked @endif>
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_view" name="permission[]" @if(in_array("warehouse_save", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" name="permission[]" @if(in_array("warehouse_save", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_delete" name="permission[]" @if(in_array("warehouse_save", $permission)) checked @endif>
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_create" name="permission[]" @if(in_array("warehouse_save", $permission)) checked @endif>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="eb-modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>

          </div>
        </form>
    </div>
  </section>

</main>
<script>
  $(document).ready(function() {
    $('.click_check').click(function() {
      var getclass=$(this).attr('child');
      var checked = $(this).prop('checked');
      $('.'+getclass).prop('checked', checked);
    });
  })
</script>

@endsection
