@extends('../layout/main')
@section('Boxes')
side_bar_active
@endsection
@section('body_content')
<style>
.bar_code > div{
  margin: auto;
}
</style>
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
          @can('box_save')
            <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
          @endcan
        <thead>
          <tr>

            <th scope="col" class="text-center">ID</th>
            <th scope="col">Name</th>
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
            <td>{{$value_row->level_id}}</td>
            <td>{{$value_row->bin_id}}</td>
            <td>{{$value_row->row_id}}</td>


            <td class="text-center">
              @can('box_update')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
              @endcan
              @can('box_Delete')
                <button type="button" class="btn btn-danger del_box" del_id="{{$value_row->id}}"><i class="far fa-trash-alt"></i></button>
              @endcan
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
                  <label for="" class="form-label">Add Levels</label>




                  <div class="form-group">
                    <div class="input-group">
                      <input type="number" class="form-control" name="level_id" id="createBox" aria-describedby="emailHelp" required>

                      <!-- <select class="form-select select_level" aria-label="Default select example" name="level_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  level-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span> -->
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Add Bins</label>




                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="bin_id" id="createBox" aria-describedby="emailHelp"  required oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">

                      <!-- <select class="form-select select_bin" aria-label="Default select example" name="bin_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  bin-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span> -->
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Add Row</label>




                  <div class="form-group">
                    <div class="input-group">
                      <!-- <select class="form-select select_row" aria-label="Default select example" name="row_id" required>
                      <option><i class="fa fa-refresh fa-spin"></i></option>

                      </select>
                      <span class="input-group-addon  row-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span> -->
                      <input type="number" class="form-control" name="row_id" id="createBox" aria-describedby="emailHelp" required>

                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label for="createBox" class="form-label">Add Box</label>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control bar_code" name="name" id="createBox" required aria-describedby="emailHelp" value="AB{{$count}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                      <span class="input-group-addon  bar_code-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </span>
                      <div class="invalid-feedback">
                        Box Name Already Exsist.
                      </div>
                    </div>
                  </div>
                  <?php $rand='AB'.$count; ?>
                  <input type="hidden" class="form-control bar_code_append" name="bar_code" value="{{$rand}}"  id="createBox" aria-describedby="emailHelp">
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 offset-md-3 bar_code">
                    {!! DNS1D::getBarcodeSVG($rand, 'C39',1.5,50,'black',false) !!}
                  </div>
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary genrate_box" name="submit_val" value="Create" >

                  <input type="submit" class="btn btn-primary genrate_box" name="submit_val" value="Create And Print" >

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
