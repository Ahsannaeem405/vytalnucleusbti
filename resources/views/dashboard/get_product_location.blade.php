@extends('../layout/main')
@section('orders')
side_bar_active
@endsection
@section('body_content')
<style>
.bar_code > div{
  margin: auto;
}
.bar_code > div{
  margin: auto;
}


.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  padding-left: 3%;
  border: 1px #dadada solid;
}
.check_box{
  padding-left: 3%;
  }

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
.ulist {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  margin-bottom: -1px;    
  border: 1px solid lightgrey;
}
.ulitems{
  width: 33%;    
  border-right: 1px solid lightgrey;
  /* text-align: center; */
  padding-left: 2%;
}
</style>

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" />
<main id="main" class="main">

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
            <td><a href="{{url('create_inventory_product/' .$value_row->get_box->id)}}" style="color: white;text-decoration: none;">{{$value_row->get_box->name}}</a></td>
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
  

</main>
<!-- End #main -->



<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function(){
        $('#eb-table').DataTable({

          "paging": false,
        });

      });

</script>
@endsection
