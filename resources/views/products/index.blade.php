
@extends('layouts.app')
@section('content')

    <!-- Start Hero Section -->
    <div class="hero p-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



		<div class="untree_co-section product-section before-footer-section p-3">
		    <div class="container">
		      	<div class="row">
                    <!-- Start Column 1 -->
                <div class="col-12 col-md-3">

                    <form  method="get"  action="{{route('shop')}}">
                        <input type="text" name="search-text" class=" form-control" placeholder="search by product name" value="{{request()->get('search-text')}}">

                        <select class="form-select mt-4" name="search-category" aria-label="Default select example">
                            <option selected disabled hidden>Search by category</option>
                            <option value="all"{{request()->get('search-category')== 'all' ?'selected' :'' }} >All</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{$category->slug}}"  {{request()->get('search-category')== $category->slug?'selected' :'' }}>{{$category->title}}</option>
                            @endforeach

                        </select>

                        <button type="submit" class="btn mt-3"> Search</button>
                    </form>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row">
                        @foreach ($products  as $product )
                            <div class="col-12 col-md-4 col-lg-3 mb-5">
                                <a class="product-item" href="{{route('products.show',$product->slug)}}">

                                    @if (!empty($product->getFirstMediaUrl('product_logo')))
                                        <img src="{{ $product->getFirstMediaUrl('product_logo') }}"
                                             class="img-fluid product-thumbnail" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://placehold.co/400" class="img-fluid product-thumbnail"
                                             alt="{{ $product->name }}">
                                    @endif
                                    <h3 class="product-title">{{$product->name}}</h3>
                                    <strong class="product-price">{{$product->price}}</strong>

                                    <span class="icon-cross">
								<img src="{{ asset('front/images/cross.svg') }} " class="img-fluid">
							</span>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
