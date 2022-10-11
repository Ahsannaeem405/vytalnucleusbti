@extends('../layout/main')
@section('inventory')
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
    <div class="row mb-5">
      <div class="col-md-4">
        <label for="" class="form-label">Filter</label>
        <div class="multiselect">
          <div class="selectBox" onclick="showCheckboxes()">
            <div class="input-group">
            <select  class="form-select">
              <option>Select an option</option>
            </select>
            <span class="input-group-addon whare-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
              <i class="fa fa-refresh fa-spin" style="color: #e52092;"></i>
            </span>
          </div>
            <div class="overSelect"></div>
          </div>
          <div id="checkboxes">
            <label for="one">
              <input type="checkbox" id="one" class="check_box check_box_rec" value="1"  />Recenty Added</label>
            <label for="two">
              <input type="checkbox" id="two" class="check_box check_box_rec" value="2"  />Recenty Updated</label>
              <?php foreach ($Wharehouse as $key => $value): ?>
                <label for="{{$value->id}}">
                  <input type="checkbox" id="three" class="check_box check_box_house" value="{{$value->id}}" />{{$value->name}}</label>

              <?php endforeach; ?>

          </div>
        </div>

      </div>

    </div>
    <div class="col-12 append_table">
      <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-6"><div id="eb-table_filter" class="dataTables_filter">
          <label style="float: right;margin-bottom: 4%;">Search:
          <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="eb-table" value="{{$product[0]->upc}}"></label>
        </div>
      </div>
    </div>
      <table class="table table-bordered" id="">
          @can('box_save')
            <button type="button" class="btn btn-primary eb-add-data" data-bs-toggle="modal" data-bs-target="#largeModal"><i class="fas fa-plus"></i>Create A Box</button>
          @endcan
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
          <?php $v=0;?>
          <?php foreach ($product as  $value_row): ?>
          <?php $v++; ?>
          <tr>
            <th scope="row" class="text-center">{{$v}}</th>
            <td><a href="{{url('create_inventory_product/' .$value_row->get_box->id)}}" style="color: white;text-decoration: none;">{{$value_row->get_box->name}}</a></td>
            <td>{{$value_row->get_box->get_ws->name}}</td>
            <td>{{$value_row->get_box->level_id}}</td>
            <td>{{$value_row->get_box->bin_id}}</td>
            <td>{{$value_row->get_box->row_id}}</td>


            <td class="text-center">
              @can('box_update')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModalEdit{{$v}}"><i class="fas fa-edit"></i></button>
              @endcan
              @can('box_Delete')
                <button type="button" class="btn btn-danger del_box" del_id="{{$value_row->get_box->id}}"><i class="far fa-trash-alt"></i></button>
              @endcan
              <a href="{{url('print_label/' .$value_row->get_box->id)}}"
              <button type="button" class="btn btn-success"><i class="fa fa-barcode" aria-hidden="true"></i></button></a>


            </td>
          </tr>
          <div class="modal fade edit_model" id="largeModalEdit{{$v}}" tabindex="-1">
            <div class="modal-dialog eb-modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form class=""   method="POST" action="{{ url('box/update/' .$value_row->get_box->id) }}">
                <div class="modal-body">


                        @csrf
                        <div class="mb-3">
                          <label for="" class="form-label">Select Warehouse</label>
                          <select class="form-select select_ws"  name="w_id" aria-label="Default select example" required>
                            <option value=""  selected="">Select Warehouse</option>
                            @foreach($Wharehouse as $row)
                            <option value="{{$row->id}}"  @if($row->id==$value_row->get_box->w_id) selected @endif>{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Add Levels</label>

                          <div class="form-group">
                            <div class="input-group">
                              <input type="number" class="form-control" name="level_id" value="{{$value_row->get_box->level_id}}" id="createBox" aria-describedby="emailHelp" required>


                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Add Bins</label>

                          <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" name="bin_id" id="createBox" aria-describedby="emailHelp" value="{{$value_row->get_box->bin_id}}"  required oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">

                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Add Row</label>
                          <div class="form-group">

                              <input type="number" class="form-control" name="row_id" id="createBox" value="{{$value_row->get_box->row_id}}" aria-describedby="emailHelp" required>

                          </div>
                        </div>
                        <?php $random=$value_row->get_box->name; ?>

                        <div class="mb-4">
                          <label for="createBox" class="form-label">Add Box</label>
                          <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control update_bar_code" name="name" id="createBox" required aria-describedby="emailHelp" new_id="{{$value_row->get_box->id}}" value="{{$random}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
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
    <div class="modal fade" id="largeModal" tabindex="-1">
      <div class="modal-dialog eb-modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <form class=""   method="POST" action="{{ url('box/save') }}">
              @csrf
              <div class="mb-3">
                <label for="" class="form-label">Select Warehouse</label>
                <select class="form-select select_ws"  name="w_id" aria-label="Default select example" required>
                  <option value=""  selected="">Select Warehouse</option>
                  @foreach($Wharehouse as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Add Levels</label>




                <div class="form-group">
                  <div class="input-group">
                    <input type="number" class="form-control" name="level_id" id="createBox" aria-describedby="emailHelp" required>

                    <!-- <select class="form-select select_level" aria-label="Default select example" name="level_id" required>
                    <option><i class="fa fa-refresh fa-spin"></i></option>

                    </select>
                    <span class="input-group-addon  level-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                      <i class="fa fa-refresh fa-spin"></i>
                    </span> -->
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Add Bins</label>




                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" name="bin_id" id="createBox" aria-describedby="emailHelp"  required oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">

                    <!-- <select class="form-select select_bin" aria-label="Default select example" name="bin_id" required>
                    <option><i class="fa fa-refresh fa-spin"></i></option>

                    </select>
                    <span class="input-group-addon  bin-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                      <i class="fa fa-refresh fa-spin"></i>
                    </span> -->
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Add Row</label>




                <div class="form-group">
                  <div class="input-group">
                    <!-- <select class="form-select select_row" aria-label="Default select example" name="row_id" required>
                    <option><i class="fa fa-refresh fa-spin"></i></option>

                    </select>
                    <span class="input-group-addon  row-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                      <i class="fa fa-refresh fa-spin"></i>
                    </span> -->
                    <input type="number" class="form-control" name="row_id" id="createBox" aria-describedby="emailHelp" required>

                  </div>
                </div>
              </div>
              <div class="mb-4">
                <label for="createBox" class="form-label">Add Box</label>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control bar_code" name="name" id="createBox" required aria-describedby="emailHelp" value="AB{{$count}}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                    <span class="input-group-addon  bar_code-loading" style="padding: 5px;border: 1px solid #ced4da;border-radius: 0rem 0.375rem 0.375rem 0rem;display:none;">
                      <i class="fa fa-refresh fa-spin"></i>
                    </span>
                    <div class="invalid-feedback">
                      Box Name Already Exsist.
                    </div>
                  </div>
                </div>
                <?php $rand='AB'.$count; ?>
                <input type="hidden" class="form-control bar_code_append" name="bar_code" value="{{$rand}}"  id="createBox" aria-describedby="emailHelp">
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 offset-md-3 bar_code" style="text-align: center;">
                  {!! DNS1D::getBarcodeSVG($rand, 'C39',1.5,50,'black',false) !!}
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

        $('.del_box').on('click', function () {
            var type=$(this).attr('del_id');
            $(".box_id").val(type);
            $('#largeModalDelete').modal('show');
        });
        $(document).on('keyup', '.update_bar_code', function() {

          $(".invalid-feedback").css('display','none');
          $(".genrate_box").attr("disabled", true);

          var id=$(this).val();
          var bin_id=$(this).attr('new_id');
          $(".bar_code_append").val(id);
          $(".bar_code-loading").css('display','block');




          $.ajax({
              type: 'get',
              url: "{{ url('/check_update_box') }}",
              data: {
                  'id': id,'bin_id':bin_id
              },
              success: function(response) {
                  $(".bar_code-loading").css('display','none');
                  if(response==200)
                  {
                    $(".invalid-feedback").css('display','none');
                    $(".genrate_box").attr("disabled", false);
                  }
                  else{
                    $(".invalid-feedback").css('display','block');
                    $(".genrate_box").attr("disabled", true);
                  }
              }
          });

        });




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
                    $(".edit_model").remove();

                    $(".tbody").empty().append(response);
                    $(".whare-loading").css('display','none');
                }
            });

        });
        var all_id=[];
        $(".check_box_house").each(function() {
         all_id.push($(this).val());

        });
        var currentRequest2 = null;
        $(document).on('click', '.check_box_rec', function() {
            $('.whare-loading').css('display','block');
            $('.check_box_rec').not(this).prop('checked', false);
            var id=[];
            var type = 0;
            var inc=0;

            $(".check_box_house:checked").each(function() {


              id.push($(this).val());

            });
            $(".check_box_rec:checked").each(function() {

              type=$(this).val();


            });


            let length = id.length;


            if(length != 0){
              var new_id=id;

            }
            else{
              var new_id=all_id;

            }
            if(type !=0){

              currentRequest2 = jQuery.ajax({
                type: 'get',
                url: "{{ url('/get_inventory') }}",

                data: {
                    'id': new_id,'type':type
                },



                 beforeSend : function()    {
                     if(currentRequest2 != null) {
                         currentRequest2.abort();
                     }
                 },
                 success: function(data) {
                   $('.whare-loading').css('display','none');
                   $(".append_table").empty().append(data);
                   type=0;

                 },
                 error:function(e){

                 }
              });
            }
            else{
              currentRequest2 = jQuery.ajax({
                type: 'get',
                url: "{{ url('/get_inventory') }}",

                data: {
                    'id': id
                },



                 beforeSend : function()    {
                     if(currentRequest2 != null) {
                         currentRequest2.abort();
                     }
                 },
                 success: function(data) {
                  $('.whare-loading').css('display','none');
                  $(".append_table").empty().append(data);
                  type=0;

                 },
                 error:function(e){

                 }
              });

            }
        });
        var currentRequest = null;




        $('.check_box_house').on('click',function(){
            $('.whare-loading').css('display','block');
            var id=[];
            var type = 0;
            var inc=0;

            $(".check_box_house:checked").each(function() {


              id.push($(this).val());

            });
            $(".check_box_rec:checked").each(function() {

              type=$(this).val();


            });


            let length = id.length;


            if(length != 0){
              var new_id=id;

            }
            else{
              var new_id=all_id;

            }
            if(type !=0){

              currentRequest = jQuery.ajax({
                type: 'get',
                url: "{{ url('/get_inventory') }}",

                data: {
                    'id': new_id,'type':type
                },



                 beforeSend : function()    {
                     if(currentRequest != null) {
                         currentRequest.abort();
                     }
                 },
                 success: function(data) {
                   $('.whare-loading').css('display','none');
                   $(".append_table").empty().append(data);
                   type=0;

                 },
                 error:function(e){

                 }
              });
            }
            else{
              currentRequest = jQuery.ajax({
                type: 'get',
                url: "{{ url('/get_inventory') }}",

                data: {
                    'id': id
                },



                 beforeSend : function()    {
                     if(currentRequest != null) {
                         currentRequest.abort();
                     }
                 },
                 success: function(data) {
                  $('.whare-loading').css('display','none');
                  $(".append_table").empty().append(data);
                  type=0;

                 },
                 error:function(e){

                 }
              });

            }

        });



  });

  var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
@endsection
