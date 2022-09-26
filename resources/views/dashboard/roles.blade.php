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
        <form class=""   method="POST" action="{{ url('create_role') }}" style="color: #000;">
          @csrf
          <div class="mb-3">
            <label for="" class="form-label">Role Name</label>
            <input class="form-control"  name="name" placeholder="Role Name"  required>

          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_dashboard">
                Dashboard
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_dashboard">
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_products">
                Products
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_products">
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_inventory">
                Inventory
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_inventory">
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_warehouse">
                Warehouse
              </label>
              <input class="form-check-input form-input-check click_check" child="warehouse" type="checkbox" value="" id="roles_warehouse">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_update" name="permission[]"  id="level_edit">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_Delete" name="permission[]" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input warehouse" type="checkbox" value="warehouse_save" name="permission[]" id="level_create">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Level
              </label>
              <input class="form-check-input form-input-check click_check" child="level" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input level" type="checkbox" value="levels"  name="permission[]"  id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_update"  name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_Delete" name="permission[]" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input level" type="checkbox" value="level_store" name="permission[]" id="level_create">
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
              <input class="form-check-input form-input-check click_check"  child="bins" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bins" name="permission[]"  id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_update" name="permission[]" >
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_Delete" name="permission[]" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input bins" type="checkbox" value="bin_save" name="permission[]" id="level_create">
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
              <input class="form-check-input form-input-check click_check"  child="all_row" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="rows" name="permission[]" id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_update" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_Delete" id="level_delete" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input all_row" type="checkbox" value="row_save" id="level_create" name="permission[]">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Box
              </label>
              <input class="form-check-input form-input-check click_check"  child="box" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input box" type="checkbox" value="Boxes" id="level_view" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_update"  name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_Delete" id="level_delete" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input box" type="checkbox" value="box_save" id="level_create" name="permission[]">
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
              <input class="form-check-input form-input-check click_check"  child="users" type="checkbox" value="" id="roles_users">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_view" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_delete" name="permission[]">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input users" type="checkbox" value="" id="level_create" name="permission[]">
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="eb-modal-footer">
            <button type="submit" class="btn btn-primary">Create</button>

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
