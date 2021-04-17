@extends('layouts.app')

@section('content')
<div class="container">
    <p>Welcome back..</p>
    <div class="products" style="margin-top:50px">
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <img src="{{$product->imagePath}}" class="image-responsive" style="width: 400px;height:380px">

            </div>
            <div class="col-md-6">
                <div class="caption">
                    <h3>{{$product->title}}</h3>
                    <p class="text-muted">{{$product->description}}</p>
                    <div class="clearfix">
                        <div class="price">
                            Price:  <b>&#x20A6; {{$product->price}}</b>
                        </div>
                        <div style="margin-top: 20px">
                            <form method="POST" action="{{route('add',$product->id)}}">
                                @csrf
                                <input type="number" name="quantity" class="form-control" style="width: 260px" required><br>
                                <input type="submit" value="Add to cart" class="btn btn-success  mt-2">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
