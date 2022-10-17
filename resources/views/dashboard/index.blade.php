@extends('../layout/main')
@section('index')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- main columns -->
      <div class="col-lg-12 eb-card-wrp">
        <div class="row">
          <!-- Level Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Warehouse</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-location-arrow"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Wharehouse)}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Levels Card -->

          <!-- Bins Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Level</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-level-up"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Level)}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Bins Card -->

          <!-- Roles Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Bins</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-columns"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Bin)}}</h6>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- End Roles Card -->

          <!-- Boxes Card -->
          <div class="col-x col-lg-3 xl-3 col-md-6">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Rows</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-columns"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{count($Row)}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="eb-table-wrp">
    <div class="row">
      <h4 style="color: black;">Recent Boxs</h4>

      <div class="col-12 ">
        <table class="table table-bordered" id="eb-table">

          <thead>
            <tr>

              <th scope="col" class="text-center">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Wharehouse</th>
              <th scope="col">Level</th>
              <th scope="col">Bin</th>
              <th scope="col">Row</th>

              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="tbody">
            <?php $v=0; ?>
            <?php foreach ($Box as  $value_row): ?>
            <?php $v++; ?>
            <tr>
              <th scope="row" class="text-center">{{$v}}</th>
              <td><a href="{{url('create_inventory_product/' .$value_row->id)}}" style="color: white;text-decoration: none;">{{$value_row->name}}</a></td>
              <td>{{$value_row->get_ws->name}}</td>
              <td>{{$value_row->level_id}}</td>
              <td>{{$value_row->bin_id}}</td>
              <td>{{$value_row->row_id}}</td>


              <td class="text-center">
                @can('box_update')
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$v}}"><i class="fas fa-edit"></i></button>
                @endcan
                @can('box_Delete')
                  <button type="button" class="btn btn-danger del_box" del_id="{{$value_row->id}}"><i class="far fa-trash-alt"></i></button>
                @endcan
                <a href="{{url('print_label/' .$value_row->id)}}"
                <button type="button" class="btn btn-success"><i class="fa fa-barcode" aria-hidden="true"></i></button></a>


              </td>
            </tr>
            <div class="modal fade edit_model" id="largeModalEdit{{$v}}" tabindex="-1">
              <div class="modal-dialog eb-modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <form class=""   method="POST" action="{{ url('box/update/' .$value_row->id) }}">
                  <div class="modal-body">


                          @csrf
                          <div class="mb-3">
                            <label for="" class="form-label">Select Warehouse</label>
                            <select class="form-select select_ws"  name="w_id" aria-label="Default select example" required>
                              <option value=""  selected="">Select Warehouse</option>
                              @foreach($Wharehouse as $row)
                              <option value="{{$row->id}}"  @if($row->id==$value_row->w_id) selected @endif>{{$row->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Add Levels</label>

                            <div class="form-group">
                              <div class="input-group">
                                <input type="number" class="form-control" name="level_id" value="{{$value_row->level_id}}" id="createBox" aria-describedby="emailHelp" required>


                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Add Bins</label>

                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control" name="bin_id" id="createBox" aria-describedby="emailHelp" value="{{$value_row->bin_id}}"  required oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">

                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Add Row</label>
                            <div class="form-group">

                                <input type="number" class="form-control" name="row_id" id="createBox" value="{{$value_row->row_id}}" aria-describedby="emailHelp" required>

                            </div>
                          </div>
                          <?php $random=$value_row->name; ?>

                          <div class="mb-4">
                            <label for="createBox" class="form-label">Add Box</label>
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control update_bar_code" name="name" id="createBox" required aria-describedby="emailHelp" new_id="{{$value_row->id}}" value="{{$random}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                                <span class="input-group-addon  bar_code-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                                  <i class="fa fa-refresh fa-spin"></i>
                                </span>
                                <div class="invalid-feedback">
                                  Box Name Already Exsist.
                                </div>
                              </div>
                            </div>


                            <input type="hidden" class="form-control bar_code_append" name="bar_code" value="{{$random}}"  id="createBox" aria-describedby="emailHelp">
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-4 offset-md-3 bar_code" style="text-align: center;">
                              {!! DNS1D::getBarcodeSVG($random, 'C39',1.5,50,'black',false) !!}
                            </div>
                          </div>


                      </div>
                      <div class="modal-footer eb-modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary genrate_box" name="submit_val" value="Create" >

                        <input type="submit" class="btn btn-primary genrate_box" name="submit_val" value="Create And Print" >

                      </div>
                    </form>


                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>

          </tbody>
        </table>

        <!-- modal -->



        <!-- modal Edit -->


        <!-- modal Delete -->
        <div class="modal fade" id="largeModalDelete" tabindex="-1">
          <div class="modal-dialog eb-modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body">
                <form class=""   method="POST" action="{{ url('box/Delete') }}">
                  @csrf

                    <input type="hidden" class="form-control box_id" id="createLevel" name="id" value="">
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
      </div>


    </div>
  </section>

</main>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
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
