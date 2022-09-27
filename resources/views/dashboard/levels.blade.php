@extends('../layout/main')
@section('show')
show
@endsection
@section('levels')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Levels</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Levels</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
          <!-- @can('level_store')
            <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
          @endcan -->
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Level Name</th>

            <th scope="col" class="">Warehouse</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0; ?>
          @foreach($Level as $row_level)
          <?php $i++; ?>
          <tr>
            <th scope="row" class="text-center">{{$i}}</th>

            <td>{{$row_level->level_id}} </td>
            <td>{{$row_level->get_ws->name}}</td>

            <!-- <td class="text-center">
                @can('level_update')
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$i}}"><i class="fas fa-edit"></i></button>
                @endcan
                @can('level_Delete')
                  <button type="button" class="btn btn-danger del_level" del_id="{{$row_level->id}}"><i class="far fa-trash-alt"></i></button>
                @endcan
            </td> -->
          </tr>
          <div class="modal fade" id="largeModalEdit{{$i}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <form class=""   method="POST" action="{{ url('level/update/' .$row_level->id) }}">
                    @csrf
                    <div class="mb-4">
                      <label for="createWarehouse" class="form-label">Warehouse</label>
                      <select class="form-select" aria-label="Default select example" name="w_id" required>
                        <option value=""  selected="">Select Warehouse</option>
                        @foreach($Wharehouse as $row)
                        <option value="{{$row->id}}" @if($row->id==$row_level->w_id) selected @endif>{{$row->name}}</option>
                        @endforeach

                      </select>
                    </div>
                    <div class="mb-4">
                      <label for="createLevel" class="form-label">Create Level</label>
                      <input type="number" class="form-control" id="createLevel" name="name" value="{{$row_level->name}}" required>
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

          @endforeach

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
              <form class=""   method="POST" action="{{ url('level/store') }}">
                @csrf
                <div class="mb-4">
                  <label for="createWarehouse" class="form-label">Warehouse</label>
                  <select class="form-select" aria-label="Default select example" name="w_id" required>
                    <option value=""  selected="">Select Warehouse</option>
                    @foreach($Wharehouse as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach

                  </select>
                </div>
                <div class="mb-4">
                  <label for="createLevel" class="form-label">Create Level</label>
                  <input type="number" class="form-control" id="createLevel" name="name" required>
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

      <!-- modal Delete -->
      <div class="modal fade" id="largeModalDelete" tabindex="-1">
        <div class="modal-dialog eb-modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
              <form class=""   method="POST" action="{{ url('level/Delete') }}">
                @csrf

                  <input type="hidden" class="form-control level_id" id="createLevel" name="id" value="">
                <div class="mb-4">
                  Are you sure you want to delete?
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="submit" class="btn btn-secondary">OK</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Large Modal-->
    </div>
  </section>

</main>
<script>
  $(document).ready(function(){

        $('.del_level').on('click', function () {
            var type=$(this).attr('del_id');
            $(".level_id").val(type);
            $('#largeModalDelete').modal('show');
        });


  });
</script>
@endsection
