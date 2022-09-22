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
        <a type="button" class="btn btn-primary eb-add-data" href="create-product.php"><i class="fas fa-plus"></i></a>
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Box Name</th>
            <th scope="col">Row</th>
            <th scope="col">Bin</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td>Product Name</td>
            <td>Box Name</td>
            <td>7</td>
            <td>A</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td>Product Name</td>
            <td>Box Name</td>
            <td>8</td>
            <td>B</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td>Product Name</td>
            <td>Box Name</td>
            <td>9</td>
            <td>C</td>
          </tr>
        </tbody>
      </table>
      <!-- End Large Modal-->
    </div>
  </section>

</main><!-- End #main -->
@endsection
