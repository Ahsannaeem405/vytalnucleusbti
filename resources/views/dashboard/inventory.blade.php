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


  });
</script>
@endsection
