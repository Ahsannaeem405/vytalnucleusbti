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
      <form method="" action="" style="color: #000;">
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
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_warehouse">
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_level">
                Level
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_edit">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_create">
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
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_edit">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_create">
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
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_edit">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_create">
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
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_level">
              <div class="ms-5">
                <div class="row">
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_view">
                      View
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_view">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_edit">
                      Edit
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_edit">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_delete">
                      Delete
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_delete">
                  </div>
                  <div class="role-action col-3">
                    <label class="form-check-label" for="level_create">
                      Create
                    </label>
                    <input class="form-check-input" type="checkbox" value="" id="level_create">
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
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_users">
            </div>
          </div>
          <div class="form-check py-3 form-check-roles">
            <div class="form-wrp">
              <label class="form-check-label form-label-title" for="roles_role">
                Roles
              </label>
              <input class="form-check-input form-input-check" type="checkbox" value="" id="roles_role">
            </div>
          </div>
        </form>
    </div>
  </section>

</main>
@endsection
