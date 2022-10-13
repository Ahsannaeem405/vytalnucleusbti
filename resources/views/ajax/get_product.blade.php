@php $p=0;$total=0; @endphp
@foreach($product as $row)
@php $p++;
  $total=$total+$row->qty;

@endphp
<tr class="tr {{$row->upc}}">
  <td>{{$row->upc}}</td>
  <input type="hidden" name="upc" class="upc_val" value="{{$row->upc}}" />
  <input type="hidden" name="id" class="upc_id" value="{{$row->id}}" />
  <td class="name">
    {{$row->name}}


  </td>
  <input type="hidden" class="qty qty_val" name="qty" value="{{$row->qty}}" />
  <td class="qty">{{$row->qty}}

  </td>
  <td class="img">
    <img src="{{$row->image}}" class="pro_img" style="max-width: 80px;max-height: 80px;" />
  </td>
  <td class="text-center">
    <button type="button" class="btn btn-success edit_product" val="{{$row->id}}" ><i class="fas fa-edit" aria-hidden="true"></i></button>
    <button type="button" class="btn btn-danger del_product" upc="{{$row->upc}}" qty="{{$row->qty}}" ><i class="far fa-trash-alt" aria-hidden="true"></i></button>
    <button="" type="button" class="btn btn-success move" upc="{{$row->id}}" qty="{{$row->qty}}"><img src="{{asset('move.png')}}"  style="width:20px;"/></button>


  </td>
</tr>
@endforeach
