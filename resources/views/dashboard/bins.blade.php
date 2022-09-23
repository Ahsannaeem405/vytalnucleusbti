@extends('../layout/main')
@section('bins')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Bins</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Bins</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
        <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Wharehouse</th>
            <th scope="col">Level</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $v=0; ?>
          <?php foreach ($Bin as  $value_bin): ?>
          <?php $v++; ?>
          <tr>
            <th scope="row" class="text-center">{{$v}}</th>
            <td>{{$value_bin->name}}</td>
            <td>{{$value_bin->get_ws->name}}</td>
              <td>{{$value_bin->get_level->name}}</td>
            <td class="text-center">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$v}}"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger del_bin" del_id="{{$value_bin->id}}"><i class="far fa-trash-alt"></i></button>

            </td>
          </tr>
          <!-- modal Edit -->
          <div class="modal fade" id="largeModalEdit{{$v}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <form class=""   method="POST" action="{{ url('bin/update/' .$value_bin->id) }}">
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Select Warehouse</label>
                      <select class="form-select select_ws"  name="w_id" aria-label="Default select example">
                        <option value=""  selected="">Select Warehouse</option>
                        @foreach($Wharehouse as $row)
                        <option value="{{$row->id}}" @if($row->id==$value_bin->w_id) selected @endif>{{$row->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Select Levels</label>




                      <div class="form-group">
                        <div class="input-group">
                          <select class="form-select select_level" aria-label="Default select example" name="level_id" required>
                            @foreach($Level as $row_Level)
                            <option value="{{$row_Level->id}}" @if($row_Level->id==$value_bin->level_id) selected @endif>{{$row_Level->name}}</option>
                            @endforeach

                          </select>
                          <span class="input-group-addon  level-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                            <i class="fa fa-refresh fa-spin"></i>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="mb-4">
                      <label for="createBin" class="form-label">Add Bin</label>
                      <input type="text" class="form-control" id="createBin" aria-describedby="emailHelp" name="name" value="{{$value_bin->name}}">
                    </div>
                    <div class="modal-footer eb-modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
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
              <form class=""   method="POST" action="{{ url('bin/save') }}">
                @csrf
                <div class="mb-3">
                  <label for="" class="form-label">Select Warehouse</label>
                  <select class="form-select select_ws"  name="w_id" aria-label="Default select example">
                    <option value=""  selected="">Select Warehouse</option>
                    @foreach($Wharehouse as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Select Levels</label>




                  <div class="form-group">
                    <div class="input-group">
                      <select class="form-select select_level" aria-label="Default select example" name="level_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  level-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="createBin" class="form-label">Add Bin</label>
                  <input type="text" class="form-control" id="createBin" aria-describedby="emailHelp" name="name">
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>




      <!-- modal Delete -->
      <div class="modal fade" id="largeModalDelete" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form class=""   method="POST" action="{{ url('bin/Delete') }}">
                @csrf

                  <input type="hidden" class="form-control bin_id" id="createLevel" name="id" value="">
                <div class="mb-4">
                  Are you sure you want to delete?
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="submit" class="btn btn-secondary" >OK</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<script>
  $(document).ready(function(){

        $('.del_bin').on('click', function () {
            var type=$(this).attr('del_id');
            $(".bin_id").val(type);
            $('#largeModalDelete').modal('show');
        });


  });
</script>
@endsection
