@extends('../layout/main')
@section('product')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="eb-table-wrp mt-5">
    <div class="col-12">
      <table class="table table-bordered" id="eb-table">
        <a type="button" class="btn btn-primary eb-add-data" href="{{url('create_product')}}"><i class="fas fa-plus"></i></a>
        <thead>
          <tr>
            <th scope="col" class="text-center">Upc</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Cost</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($product as $row)
          <tr>
            <th scope="row" class="text-center">{{$row->upc}}</th>
            <td>{{$row->name}}</td>
            <td>{{$row->description}}</td>
            <td></td>
            <td></td>
            <td>{{$row->qty}}</td>
            <td><img src="{{$row->image}}" style="max-width: 80px;max-height: 80px;" /></td>
            <td>
                <button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button>

                <button type="button" class="btn btn-success"><i class="fas fa-edit" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-danger del_box" del_id="1"><i class="far fa-trash-alt" aria-hidden="true"></i></button>



            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      <!-- End Large Modal-->
    </div>
  </section>

</main><!-- End #main -->
@endsection
