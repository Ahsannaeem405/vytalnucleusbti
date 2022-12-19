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
    <h1>Orders</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
        <li class="breadcrumb-item active">Orders</li>
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
            <th scope="col">Order Id</th>
            <th>From</th>
            <th>IMS Status</th>
            <th>Store Status</th>

            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody class="tbody">
          <?php $v=0; ?>
          @foreach($orders as  $key => $value_row)
          {{--order detail model --}}
          <?php $v++; ?>
          <div class="modal fade edit_model" id="largeModalEdit{{$v}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <h3>Order Details</h3>

                  {{-- <table>
                    <tr>
                      <th>product upc</th>
                      <th>quantity</th>
                    </tr> --}}
                    <ul class="p-3 ulist">
                      <li class="ulitems" style="font-weight: bold;">Product UPC</li>
                      <li class="ulitems" style="font-weight: bold;">Product Name</li>
                      <li style="font-weight: bold;padding-left: 2%;">Quantity</li>
                    </ul>
                    @php
                      $quantity_count = 0;
                      $order_from = "";
                      $order_status = "";
                    @endphp
                    @foreach($value_row as $order)
                    @php 
                    $quantity_count = $quantity_count + $order->quantity;
                    $order_from = $order->order_from;
                    $order_status = $order->status;
                    $orderid = $order->order_id;
                    @endphp
                    <ul class="p-3 ulist">
                      <li class="ulitems">{{$order->product->upc}}</li>
                      <li class="ulitems">{{$order->product->name}}</li>
                      <li style="padding-left: 2%;"><p>{{$order->total_qty}}</p>
                        @if($order->remove_qty != null)
                          <p style="color:red;">({{$order->remove_qty}} quantity removed)<p>
                        @endif
                        <a target="_blank" href="{{url('get_product_location')}}?upc={{$order->product->upc}}">go to location</a>
                      </li>
                    </ul>
                      {{-- <p>{{$order->product->name}}</p>
                      <p>{{$order->quantity}}</p> --}}
                    @endforeach

                  {{-- </table> --}}
                    <div class="modal-footer eb-modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
          {{-- model end --}}
          <tr>
            <th scope="row" class="text-center">{{$v}}</th>
            <td>{{$key}}</td>
            <td>{{$order_from}}</td>
            <td>
              @if($quantity_count < 1)
                <button type="button" class="btn btn-success" style="background: green;color: white;">Completed</button>
              @else
                <button type="button" class="btn btn-success" style="background: deepskyblue;color: white;">Pending</button>
              @endif
            </td>
            <td>
              @if($order_status == "unfulfilled")
                <form action="{{url('change_status')}}/{{$orderid}}" method="post">
                  @csrf
                  <button onclick="return confirm('Are you sure you want to change status?')" type="submit" class="btn btn-success" style="background: deepskyblue;color: white;">Unfulfilled</button>
                </form>
              @else
                <button type="button" class="btn btn-success" style="background: green;color: white;">Fulfilled</button>

              @endif
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$v}}"><i class="fas fa-eye"></i> View</button>

            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

      <!-- modal -->



      <!-- modal Edit -->


      <!-- modal Delete -->
      
    </div>

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
