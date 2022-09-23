@extends('../layout/main')
@section('Boxes')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Boxes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Boxes</li>
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
            <th scope="col">Bin</th>
            <th scope="col">Row</th>

            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $v=0; ?>
          <?php foreach ($Box as  $value_row): ?>
          <?php $v++; ?>
          <tr>
            <th scope="row" class="text-center">{{$v}}</th>
            <td>{{$value_row->name}}</td>
            <td>{{$value_row->get_ws->name}}</td>
            <td>{{$value_row->get_level->name}}</td>
            <td>{{$value_row->get_bin->name}}</td>
            <td>{{$value_row->get_row->name}}</td>
            <td class="text-center">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger del_box" del_id="{{$value_row->id}}"><i class="far fa-trash-alt"></i></button>
            </td>
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
              <form class=""   method="POST" action="{{ url('box/save') }}">
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
                <div class="mb-3">
                  <label for="" class="form-label">Select Row</label>




                  <div class="form-group">
                    <div class="input-group">
                      <select class="form-select select_row" aria-label="Default select example" name="row_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  row-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label for="createBox" class="form-label">Add Box</label>
                  <input type="text" class="form-control" name="name" id="createBox" aria-describedby="emailHelp">
                  <?php $rand=rand(1111122222,9999988888) ?>
                  <input type="hidden" class="form-control" name="bar_code" value="{{$rand}}"  id="createBox" aria-describedby="emailHelp">
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create </button>
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
              <form class=""   method="POST" action="{{ url('box/Delete') }}">
                @csrf

                  <input type="hidden" class="form-control box_id" id="createLevel" name="id" value="">
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
<!-- End #main -->


<script>
  $(document).ready(function(){

        $('.del_box').on('click', function () {
            var type=$(this).attr('del_id');
            $(".box_id").val(type);
            $('#largeModalDelete').modal('show');
        });


  });
</script>
@endsection
