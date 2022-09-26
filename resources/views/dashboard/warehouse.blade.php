@extends('../layout/main')
@section('warehouse')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Warehouse</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Warehouse</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
          @can('warehouse_save')
            <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
          @endcan
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0; ?>
          @foreach($Wharehouse as $value)
          <?php $i++; ?>


          <tr>
            <th scope="row" class="text-center">{{$i}}</th>
            <td>{{$value->name}} </td>
            <td class="text-center">
              @can('warehouse_update')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$i}}"><i class="fas fa-edit"></i></button>
              @endcan
              @can('warehouse_Delete')
                <button type="button" class="btn btn-danger del_wharehouse" del_id="{{$value->id}}"><i class="far fa-trash-alt"></i></button>
              @endcan  

            </td>
          </tr>


          <div class="modal fade" id="largeModalEdit{{$i}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">

                  <form class=""   method="POST" action="{{ url('warehouse/update/' .$value->id) }}">
                    @csrf
                    <div class="mb-4">
                      <label for="createLevel" class="form-label">Warehouse Name</label>
                      <input type="text" class="form-control" id="createLevel" name="name" value="{{$value->name}}">
                    </div>
                    <div class="modal-footer eb-modal-footer">
                      <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Update</button>
                      <button type="button" class="btn btn-primary">Cancel</button>
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
                <form class=""   method="POST" action="{{ url('warehouse/save') }}">
                @csrf
                <div class="mb-4">
                  <label for="createLevel" class="form-label">Warehouse Name</label>
                  <input type="text" class="form-control" id="createLevel" name="name">
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
              <form class=""   method="POST" action="{{ url('warehouse/Delete') }}">
                @csrf

                  <input type="hidden" class="form-control wharehouse_id" id="createLevel" name="id" value="{{$value->name}}">
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
      <!-- End Large Modal-->
    </div>
  </section>

</main>

<script>
  $(document).ready(function(){

        $('.del_wharehouse').on('click', function () {
            var type=$(this).attr('del_id');
            $(".wharehouse_id").val(type);
            $('#largeModalDelete').modal('show');
        });


  });
</script>
@endsection
