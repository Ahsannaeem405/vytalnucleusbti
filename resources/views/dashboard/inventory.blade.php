@extends('../layout/main')
@section('inventory')
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
    <h1>Inventory</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Inventory</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="eb-table-wrp mt-5">
    <div class="row mb-5">
      <div class="col-md-4">
        <label for="" class="form-label">Select Warehouse</label>
        <div class="form-group">
          <div class="input-group">
            <select class="form-select chang_inventory_warehouse " aria-label="Default select example" name="row_id" required>

            <option>All</option>
            <?php foreach ($Wharehouse as $key => $value_Wharehouse): ?>
              <option value="{{$value_Wharehouse->id}}">{{$value_Wharehouse->name}}</option>

            <?php endforeach; ?>



            </select>
            <span class="input-group-addon whare-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
              <i class="fa fa-refresh fa-spin" style="color: #e52092;"></i>
            </span>

          </div>
        </div>
      </div>

    </div>

    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
          <!-- @can('box_save')
            <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
          @endcan -->
        <thead>
          <tr>

            <th scope="col" class="text-center">ID</th>
            <th scope="col">Box</th>
            <th scope="col">Wharehouse</th>
            <th scope="col">Level</th>
            <th scope="col">Bin</th>
            <th scope="col">Row</th>

          </tr>
        </thead>
        <tbody class="tbody">
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



          </tr>
          <?php endforeach; ?>

        </tbody>
      </table>

      <!-- modal -->




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
        $('.chang_inventory_warehouse').on('change', function () {
            var id=$(this).val();
            $(".whare-loading").css('display','block');


            $.ajax({
                type: 'get',
                url: "{{ url('/get_inventory') }}",
                data: {
                    'id': id
                },
                success: function(response) {

                    $(".tbody").empty().append(response);
                    $(".whare-loading").css('display','none');
                }
            });

        });



  });
</script>
@endsection
