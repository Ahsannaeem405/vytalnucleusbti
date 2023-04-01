@extends('../layout/main')
@section('show_2')
show
@endsection
@section('users')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->
  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      @if ($errors->any())
       @foreach ($errors->all() as $error)
   <div class="alert alert-danger">

     {{ $error }}<br>
     </div>
   @endforeach

   @endif
      <table class="table table-bordered" id="eb-table">
        <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">User Name</th>
            <th scope="col">Role</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $u=0;  ?>
          <?php foreach ($user as $key => $value): ?>
          <?php $u++;  ?>
            <tr>
              <td>{{$u}}</td>
              <td>{{$value->name}}</td>
              <td>{{$value->email}}</td>
              <td>{{$value->username}}</td>

              <td>@if($value->get_role !=null){{$value->get_role->role_name->name}}  @endif </td>

              <td class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$u}}"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>
            <div class="modal fade" id="largeModalEdit{{$u}}" tabindex="-1">
              <div class="modal-dialog eb-modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <div class="modal-body">
                    <form class="row g-3 " method="POST" action="{{ url('user/update/' .$value->id) }}">
                        @csrf
                      <h1 class="text-center">User Information</h1>
                      <div class="col-12 eb-user-form-wrp d-flex">
                        <div class="col-12">
                          <label for="first_name" class="form-label">Name</label>
                          <input type="text" name="name" value="{{$value->name}}" class="form-control" id="first_name" required>
                          <div class="invalid-feedback">Please, enter your name!</div>
                        </div>
                      </div>


                      <div class="col-12 eb-user-form-wrp d-flex">
                        <div class="col-12">
                          <label for="yourEmail" class="form-label">Email</label>
                          <input type="email" name="email" value="{{$value->email}}" class="form-control" id="yourEmail" required>
                          <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
                      </div>

                      <div class="col-12 eb-user-form-wrp d-flex">
                        <div class="col-12">
                          <label for="Username" class="form-label">User Name</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" value="{{$value->username}}" class="form-control" id="Username" required>
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 eb-user-form-wrp d-flex">
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Role</label>
                          <select class="form-select select_ws"  name="role" aria-label="Default select example" required>

                            @foreach($role as $row)
                            <option value="{{$row->id}}" @if($value->get_role !=null) @if($row->id==$value->get_role->role_name->id) selected @endif @endif>{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-12 my-2 text-center">
                        <button class="btn btn-primary w-50 mt-3 eb-user-form-btn" type="submit">Update User</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


          <?php endforeach; ?>

        </tbody>
      </table>

      <!-- modal -->
      <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form class="row g-3 " method="POST" action="{{ url('user/create/') }}">
                  @csrf
                <h1 class="text-center">User Information</h1>
                <div class="col-12 eb-user-form-wrp d-flex">
                  <div class="col-12">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="name" class="form-control" id="first_name" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                  </div>
                </div>

                <div class="col-12 eb-user-form-wrp d-flex">
                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="yourEmail" required>
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                  </div>
                </div>

                <div class="col-12 eb-user-form-wrp d-flex">
                  <div class="col-12">
                    <label for="Username" class="form-label">User Name</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="username" class="form-control" id="Username" required>
                      <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                  </div>
                </div>

                <div class="col-12 eb-user-form-wrp d-flex">
                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>
                </div>
                <div class="col-12 eb-user-form-wrp d-flex">
                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Role</label>
                    <select class="form-select select_ws"  name="role" aria-label="Default select example" required>

                      @foreach($role as $row)
                      <option value="{{$row->id}}" >{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-12 my-2 text-center">
                  <button class="btn btn-primary w-50 mt-3 eb-user-form-btn" type="submit">Create User</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- modal Edit -->

      <!-- modal Delete -->
      <div class="modal fade" id="largeModalDelete" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-4">
                  Are you sure you want to delete?
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                  <button type="button" class="btn btn-primary">Cancel</button>                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
