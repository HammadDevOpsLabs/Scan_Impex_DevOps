
@extends('layouts.app')
@section('content')

    <!-- Start Hero Section -->
    <div class="hero p-3 ">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    <div class="untree_co-section m-3">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-name">quantity</th>
                                <th class="product-price">Price</th>
                                <th class="product-price">total Price</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr>
                                    <td class="product-thumbnail">

                                        @if (!empty($cartItem->product->getFirstMediaUrl('product_logo')))
                                            <img src="{{ $cartItem->product->getFirstMediaUrl('product_logo') }}"
                                                 class="img-fluid " alt="{{ $cartItem->product->name }}">
                                        @else
                                            <img src="https://placehold.co/400" class="img-fluid
                                             alt="{{ $cartItem->product->name }}">
                                        @endif
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{$cartItem->product->name}}</h2>
                                    </td>
                                    <td class="product-name ">
                                        <input type="number" data-change-url="{{route('update-quantity',$cartItem->id)}}" class="form-control m-auto" id="quantity" placeholder="quantity" style="width: 100px;" min="1" value="{{$cartItem->quantity}}">

                                    </td>
                                    <td>{{$cartItem->product->price}}</td>
                                    <td>{{$cartItem->product->price * $cartItem->quantity}}</td>

                                    <td><a href="{{route('remove-from-cart',$cartItem->product->id)}}" class="btn-danger p-2 remove" style="text-decoration: none">X</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">

                        <div class="col-md-6">
                            <a class="btn btn-outline-black btn-sm btn-block" href="{{route('shop')}}">Continue Shopping</a>
                        </div>
                    </div>
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-md-12">--}}
                    {{--                            <label class="text-black h4" for="coupon">Coupon</label>--}}
                    {{--                            <p>Enter your coupon code if you have one.</p>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-md-8 mb-3 mb-md-0">--}}
                    {{--                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-md-4">--}}
                    {{--                            <button class="btn btn-black">Apply Coupon</button>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{$totalPrice}}</strong>
                                </div>
                            </div>
                            @if(!$cartItems->isEmpty())

                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-black btn-lg py-3 btn-block" href="{{route('checkout')}}">Proceed To Checkout</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>


        $(".remove").click(function (e) {
            e.preventDefault();

            var $this = $(this);
            $.ajax({
                type:'POST',
                url:$(this).attr('href'),
                data: {
                    '_token' : '{{csrf_token()}}',
                },
                success:function(data) {

                    if(data['success']){
                        toastr.success(data['message'])
                    }
                    else {
                        toastr.error(data['message'])
                    }
                },

            });

        })

        $('#quantity').change(function (){

            $.ajax({
                type:'get',
                url:$(this).data('change-url'),
                data: {
                    '_token' : '{{csrf_token()}}',
                    'quantity':  $('#quantity').val()
                },
                success:function(data) {

                    if(data['success']){

                        window.location.reload();
                    }
                    else {
                        toastr.error(data['message'])
                    }
                },

            });

        })
    </script>
@endpush
