<option value=""  selected="">Select Levels</option>
@foreach($Bin as $row)
<option value="{{$row->id}}">{{$row->name}}</option>
@endforeach
