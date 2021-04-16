@extends('layouts.app')

@section('content')
<div class="container">
    <p>Welcome back..</p>
    <div class="products" style="margin-top:30px">

        @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as  $product)

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{$product->imagePath}}" class="image-responsive" style="width: 300px;height:280px">
                    <div class="caption">
                        <h3>{{$product->title}}</h3>
                        <div class="clearfix">
                            <div class="">
                                ${{$product->price}}
                            </div>
                                <a href="{{route('index')}}" class="btn btn-success pull-right"  role="button">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4"></div>
            </div>
            @endforeach
        </div>

        @endforeach
    </div>
</div>
@endsection
