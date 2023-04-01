<option value=""  selected="">Select Levels</option>
@foreach($Row as $row)
<option value="{{$row->id}}">{{$row->name}}</option>
@endforeach
