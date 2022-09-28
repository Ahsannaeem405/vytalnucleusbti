@extends('../layout/main')
@section('show_2')
show
@endsection
@section('roles')
side_bar_active
@endsection
@section('body_content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
    </nav>
  </div>
  <section class="eb-table-wrp">
    <div class="col-12">
    <a href="{{url('create_roles')}}"><button type="button" class="btn btn-primary eb-add-data"><i class="fas fa-plus" aria-hidden="true"></i></button></a>
      <h4 class="mb-4">Roles</h4>
      <table class="table table-bordered" id="eb-table">
        <thead>
          <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">Title</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $k=0; ?>
          <?php foreach ($role as $value): ?>
          <?php $k++; ?>

            <tr>
              <th scope="row" class="text-center">{{$k}}</th>
              <td>{{$value->name}} </td>
              <td class="text-center">
                <a href="{{url('edit_role/' .$value->id)}}"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
              </td>
            </tr>

          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </section>
  <!-- End Page Title -->

</main>
<script>
  $(document).ready(function() {
    $('.click_check').click(function() {
      var getclass=$(this).attr('child');
      var checked = $(this).prop('checked');
      $('.'+getclass).prop('checked', checked);
    });
  })
</script>

@endsection
