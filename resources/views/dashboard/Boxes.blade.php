@extends('../layout/main')
@section('Boxes')
side_bar_active
@endsection
@section('body_content')
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
        <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i></button>
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Level</th>
            <th scope="col">Bins</th>
            <th scope="col">Rows</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td>1</td>
            <td>A</td>
            <td>12</td>
            <td class="text-center">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td>2</td>
            <td>B</td>
            <td>9</td>
            <td class="text-center">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td>Lorem Ipsum is simply dummy text of the </td>
            <td>3</td>
            <td>C</td>
            <td>10</td>
            <td class="text-center">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit"><i class="fas fa-edit"></i></button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalDelete"><i class="far fa-trash-alt"></i></button>
            </td>
          </tr>
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
              <form>
                <div class="mb-3">
                  <label for="" class="form-label">Select Level</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>1</option>
                    <option value="1">2</option>
                    <option value="2">3</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Select Bins</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>A</option>
                    <option value="1">B</option>
                    <option value="2">C</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Select Rows</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>12</option>
                    <option value="1">2</option>
                    <option value="2">6</option>
                  </select>
                </div>
                <div class="mb-4">
                  <label for="createBox" class="form-label">Add Box</label>
                  <input type="text" class="form-control" id="createBox" aria-describedby="emailHelp">
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Create</button>
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
              <form>
                <div class="mb-4">
                  Are you sure you want to delete?
                </div>
                <div class="modal-footer eb-modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                  <button type="button" class="btn btn-primary">Cancel</button>                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<!-- End #main -->
@endsection
