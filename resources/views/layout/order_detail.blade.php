<table class="table">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Quantitysss</th>
      </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
          @if($order->quantity > 0)
            <tr>
                <td>{{$order->product->name}}</td>
                <td>
                  {{$order->total_qty}}
                  @if($order->remove_qty != null)
                    <p style="color:red;">({{$order->remove_qty}} quantity removed)<p>
                  @endif
                  
                </td>
            </tr>
          @endif
        @endforeach
    </tbody>
  </table>