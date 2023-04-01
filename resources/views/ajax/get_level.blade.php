<option value=""  selected="">Select Levels</option>
@foreach($Level as $row)
<option value="{{$row->id}}">{{$row->name}}</option>
@endforeach
