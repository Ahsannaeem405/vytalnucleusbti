@extends('../layout/main')
@section('show')
show
@endsection
@section('rows')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Rows</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Rows</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Warehouse</th>
            <!-- <th scope="col" class="text-center">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php $v=0; ?>
          <?php foreach ($Row as  $value_row): ?>
          <?php $v++; ?>
          <tr>
            <th scope="row" class="text-center">{{$v}}</th>
            <td>{{$value_row->row_id}}</td>
            <td>{{$value_row->get_ws->name}}</td>


            <!-- <td class="text-center">
                @can('row_update')
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
                @endcan
                @can('row_Delete')
                  <button type="button" class="btn btn-danger del_row" del_id="{{$value_row->id}}"><i class="far fa-trash-alt"></i></button>
                @endcan
            </td> -->
          </tr>
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
              <form class=""   method="POST" action="{{ url('row/save') }}">
                @csrf
                <div class="mb-3">
                  <label for="" class="form-label">Select Warehouse</label>
                  <select class="form-select select_ws"  name="w_id" aria-label="Default select example" required>
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
                <div class="mb-3">
                  <label for="" class="form-label">Select Bins</label>




                  <div class="form-group">
                    <div class="input-group">
                      <select class="form-select select_bin" aria-label="Default select example" name="bin_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  bin-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label for="createRow" class="form-label">Add Row</label>
                  <input type="number" class="form-control"  name="name" id="createRow" aria-describedby="emailHelp" required>
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



      <!-- modal Edit -->
      <div class="modal fade" id="largeModalEdit" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-4">
                  Are you sure you want to edit?
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                  <button type="button" class="btn btn-primary">Cancel</button>                  </div>
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
              <form class=""   method="POST" action="{{ url('row/Delete') }}">
                @csrf

                  <input type="hidden" class="form-control row_id" id="createLevel" name="id" value="">
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

        $('.del_row').on('click', function () {
            var type=$(this).attr('del_id');
            $(".row_id").val(type);
            $('#largeModalDelete').modal('show');
        });


  });
</script>
@endsection
