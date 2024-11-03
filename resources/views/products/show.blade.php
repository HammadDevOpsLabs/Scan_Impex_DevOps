
@extends('layouts.app')
@section('content')

    <!-- Start Hero Section -->
    <div class="hero p-3 ">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>{{$product->name}}</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <div class="untree_co-section product-section  p-3">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-8 order-2 order-md-1">

                    {!! $product->descreption !!}
                    <h5>price : {{$product->price}}</h5>


                    <div class="my-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="quantity" style="width: 100px;" min="1" value="1">
                    </div>

                    <button class="btn btn-success add-to-card" type="button">add to cart  <img src="{{ asset('front/images/cart.svg') }} ">  </button>

                </div>
                <div class="col-12 col-md-4 order-1 order-md-2">

                    @if (!empty($product->getFirstMediaUrl('product_logo')))
                        <img src="{{ $product->getFirstMediaUrl('product_logo') }}"
                             class="img-fluid product-thumbnail" alt="{{ $product->name }}">
                    @else
                        <img src="https://placehold.co/400" class="img-fluid product-thumbnail"
                             alt="{{ $product->name }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')


    <script>

        $(".add-to-card").click(function (e) {

            @if(auth()->check())
            $.ajax({
                type:'POST',
                url:'{{route('add-to-cart',$product->id)}}',
                data: {
                    '_token' : '{{csrf_token()}}',
                    'quantity':$("#quantity").val()
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


        @else
        toastr.error("@lang('Login first to add product to cart')")

        @endif
        })
    </script>


@endpush
