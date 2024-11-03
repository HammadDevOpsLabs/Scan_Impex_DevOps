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
                    <form class="card mb-5" method="post" action="{{route('update-profile')}}">
                        @csrf
                        <div class="card-header">
                            Profile data
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label class="p-2" for="nameInput">Name</label>
                                    <input type="text" name="name" class="form-control" id="nameInput" placeholder="Enter your name" value="{{auth()->user()->name}}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="p-2" for="emailInput">Email address</label>
                                    <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter email" value="{{auth()->user()->email}}">
                                </div>
                                <div class="form-group">
                                    <label class="p-2" for="phoneInput">Phone number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phoneInput" placeholder="Enter phone number" value="{{auth()->user()->phone_number}}">
                                </div>
                                <div class="form-group">
                                    <label class="p-2" for="addressInput">Address</label>
                                    <input type="text" name="address" class="form-control" id="addressInput" placeholder="Enter address" value="{{auth()->user()->address}}">
                                </div>

                                <div class="form-group col-6">
                                    <label class="p-2" for="passwordInput">new Password</label>
                                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
                                </div>
                                <div class="form-group col-6">
                                    <label class="p-2" for="passwordInput">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="passwordInput" placeholder="Password">
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update profile</button>
                        </div>

                    </form>
                </div>

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
                                        <th class="product-thumbnail">Order number</th>
                                        <th class="product-price">total price</th>
                                        <th class="product-remove">payment type</th>
                                        <th class="product-name">Status</th>
                                        <th class="product-remove">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders  as $order)
                                        <tr>
                                            <td class="product-name">
                                                {{$order->order_number}}
                                            </td>
                                            <td>{{$order->total_amount}}</td>
                                            <td>{{$order->payment}}</td>
                                            <td>{{$order->status}}</td>

                                            <td><a href="{{route('order-items',$order->id)}}" class="btn-primary p-2" style="text-decoration: none">items</a></td>
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
