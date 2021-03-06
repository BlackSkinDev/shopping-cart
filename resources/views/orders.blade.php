@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>My Orders</h2>
            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart as $item)
                                <li class="list-group-item">
                                    <span class="badge">&#x20A6;{{ $item['price'] }}</span>
                                    {{ $item['title'] }} | {{ $item['quantity'] }} Units | Price per unit: &#x20A6;{{$item['price']}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total Price: &#x20A6;{{ $order->amount }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
