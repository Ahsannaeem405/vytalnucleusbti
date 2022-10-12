@if($count!=0)
<div class="col-md-12 mb-2 next_child">
  <select class="form-select change_cat" name="cat[]">

    <?php foreach ($cat as $cat_row): ?>
      <option value="{{$cat_row->id}}">
        {{$cat_row->title}}
      </option>

    <?php endforeach; ?>
  </select>
</div>
@endif
