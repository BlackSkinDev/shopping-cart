@extends('layouts.app')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1>Checkout</h1>
            @if(Session::has('error'))
                {{Session::get('error')}}
            @endif
            <h4>Your Total: ${{ session('grandPrice') }}</h4>
            <form action="{{ route('pay') }}" method="post" id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" required name="name" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" required name="address">
                        </div>
                    </div>
                    <hr>
                 </div>
                <button type="submit" class="btn btn-success">Pay <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
            </form>
        </div>
    </div>
@endsection

