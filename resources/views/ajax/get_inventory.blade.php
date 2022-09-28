<?php $v=0; ?>
<?php foreach ($Box as  $value_row): ?>
<?php $v++; ?>
<tr>
  <th scope="row" class="text-center">{{$v}}</th>
  <td>{{$value_row->name}}</td>
  <td>{{$value_row->get_ws->name}}</td>
  <td>{{$value_row->level_id}}</td>
  <td>{{$value_row->bin_id}}</td>
  <td>{{$value_row->row_id}}</td>



</tr>
<?php endforeach; ?>
