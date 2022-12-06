<div class="pagetitle">
  <h1>Inventory</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
      <li class="breadcrumb-item active">Inventory</li>
    </ol>
  </nav>
</div>
<!-- End Page Title -->

<section class="eb-table-wrp mt-5">


  <div class="col-12 append_table">
    <table class="table table-bordered" id="eb-table">
        
      <thead>
        <tr>

          <th scope="col" class="text-center">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Qty</th>
          <th scope="col" >Box</th>
          <th scope="col">Warehouse</th>
          <th scope="col">Level</th>
          <th scope="col">Bin</th>
          <th scope="col">Row</th>


        </tr>
      </thead>
      <tbody class="tbody">
        <?php $v=0; ?>
        <?php foreach ($product as  $value_row): ?>
        <?php $v++; ?>
        <tr>
          <th scope="row" class="text-center">{{$v}}</th>
          <td>{{$value_row->name}}</td>
          <td>{{$value_row->qty}}</a></td>
          <td>{{$value_row->get_box->name}}</td>
            <td>{{$value_row->get_box->get_ws->name}}</td>
          <td>{{$value_row->get_box->level_id}}</td>
          <td>{{$value_row->get_box->bin_id}}</td>
          <td>{{$value_row->get_box->row_id}}</td>



        </tr>

        <?php endforeach; ?>

      </tbody>
    </table>

    <!-- modal -->



    <!-- modal Edit -->


    <!-- modal Delete -->

</section>
