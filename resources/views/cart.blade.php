@extends('layouts.app')
@section('title', 'Cart')
@section('content')


        @if(session('cart'))
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product Name</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%">Action</th>
            </tr>
            </thead>
            <tbody>



            @foreach(session('cart') as $id => $details)


                <tr id="{{$id}}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['imagePath'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['title'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['total_price']}}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-warning btn-sm update" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{ $details['total_price'] }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"><a href="{{ route('checkout') }}" class="btn btn-success"> Checkout  <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></td>
            <td class="hidden-xs text-center"><strong>Total ${{ session('grandPrice') }}</strong></td>
        </tr>
        </tfoot>
    </table>
        @else
            <h4>No item in cart</h4>
        @endif


@endsection


@section('scripts')
<script type="text/javascript">

    $(".update").click(function (e) {
       e.preventDefault();
       var button = $(this);

        if(button.parents("tr").find(".quantity").val()==0){
            alert("Qunatity cannot be 0")
        }
        else{
            $.ajax({
                url: '{{ route('update') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: button.attr("data-id"), quantity: button.parents("tr").find(".quantity").val()},
                success: function (response) {
                    //console.log(response)
                    window.location.reload();
                }
            });
        }

    });
    $(".remove").click(function (e) {

        e.preventDefault();
        var button = $(this);
        if(confirm("Remove from cart?")) {
            $.ajax({
                url: '{{ route('remove') }}',
                method: "delete",
                data: {_token: '{{ csrf_token() }}', id: button.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });



    </script>

@endsection

