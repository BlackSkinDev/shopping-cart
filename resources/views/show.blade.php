@extends('layouts.app')

@section('content')
<div class="container">
    <p>Welcome back..</p>
    <div class="products" style="margin-top:50px">
        <div class="row">
            <div class="col-md-6">
                <img src="{{$product->imagePath}}" class="image-responsive" style="width: 400px;height:380px">

            </div>
            <div class="col-md-6">
                <div class="caption">
                    <h3>{{$product->title}}</h3>
                    <p>{{$product->description}}</p>
                    <div class="clearfix">
                        <div class="price">
                            <b>${{$product->price}}</b>
                        </div>
                        <div class="mt-4">
                            <input type="number" class="form-control" style="width: 250px"><br>
                            <a href="{{route('show',$product->id)}}" class="btn btn-success pull-right mt-2"  role="button">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
