@extends('layouts.app')
@section('content')



    <div class="hero p-3 ">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Profile</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    <div class="untree_co-section p-3">
        <div class="container">

            <div class="row">


                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            Orders
                        </div>
                        <div class="card-body">
                            <div class="site-blocks-table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product</th>
                                        <th class="product-price">quantity</th>
                                        <th class="product-remove">price</th>
                                        <th class="product-name">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderItems  as $orderItem)
                                        <tr>
                                            <td class="product-name">
                                                {{$orderItem->product->name}}
                                            </td>
                                            <td>{{$orderItem->quantity}}</td>
                                            <td>{{$orderItem->product->price}}</td>
                                            <td>{{$orderItem->product->price * $orderItem->quantity}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
