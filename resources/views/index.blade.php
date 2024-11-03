
@extends('layouts.app')
   @section('content')
   <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Premium Loft Ladders for Modern Homes and Businesses
                        </h1>
                        <p class="mb-4">Enhance your space with our exclusive, easy-to-install loft ladders. Crafted with quality and designed for durability, Scan-Impex offers loft ladders that blend functionality with sleek aesthetics..</p>
                        <p><a href="{{route('shop')}}" class="btn btn-secondary me-2">Shop Now</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('front/images/couch.png') }} " class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 h-auto">
                        <a class="product-item" href="{{route('products.by-category',$category->slug)}}">

                            <div style="">
                                @if (!empty($category->getFirstMediaUrl('category_logo')))
                                    <img src="{{ $category->getFirstMediaUrl('category_logo') }}"
                                        class="img-fluid product-thumbnail" alt="{{ $category->title }}">
                                @else
                                    <img src="https://placehold.co/400" class="img-fluid product-thumbnail"
                                        alt="{{ $category->title }}">
                                @endif
                            </div>
                            <h3 class="product-title">{{ $category->title }}</h3>

                        </a>
                    </div>
                @endforeach
                <!-- Start Column 2 -->



                <!-- End Column 2 -->

                <!-- Start Column 3 -->

                <!-- End Column 4 -->
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Scan-Impex?
                    </h2>
                    <p>Our high-quality loft ladders are designed for easy installation and long-lasting durability, providing the best solution for both homes and businesses. Here's why Scan-Impex is the right choice for you:</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('front/images/truck.svg') }} " alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast & Reliable Delivery
                                </h3>
                                <p>We ensure quick delivery of our ready-to-install loft ladders, making it easy for you to complete your projects on time.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('front/images/bag.svg') }} " alt="Image" class="imf-fluid">
                                </div>
                                <h3>Effortless Installation
                                </h3>
                                <p>All of our loft ladders come pre-assembled for easy, hassle-free installation — no complex tools or experience required.
                                    .</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('front/images/support.svg') }} " alt="Image"
                                        class="imf-fluid">
                                </div>
                                <h3>Expert Customer Support
                                </h3>
                                <p>Our team is available to assist you at every step, from product selection to after-sales support.
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('front/images/return.svg') }} " alt="Image"
                                        class="imf-fluid">
                                </div>
                                <h3>Hassle-Free Returns
                                </h3>
                                <p>We offer flexible return policies to ensure complete satisfaction with your purchase..</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('front/images/why-choose-us-img.jpg') }} " alt="Image"
                            class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{ asset('front/images/img-grid-1.jpg') }} "
                                alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="{{ asset('front/images/img-grid-2.jpg') }} "
                                alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="{{ asset('front/images/img-grid-3.jpg') }} "
                                alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">We Help You Build Efficient Loft Solutions
                    </h2>
                    <p>At Scan-Impex, we specialize in providing high-quality loft ladders and accessories that enhance your home's space and functionality. Our products are designed for easy installation, durability, and optimal safety. Whether you're looking for premium fire-resistant loft ladders or efficient space-saving solutions, we've got you covered.
                    </p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Durable and fire-resistant loft ladders for long-term safety</li>
                        <li>Easy-to-install designs for hassle-free setup
                        </li>
                        <li>Customizable options to fit different ceiling heights
                        </li>
                        <li>Accessories to complement and enhance ladder functionality</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">






            </div>
        </div>
    </div>
    <!-- End Popular Product -->
@endsection
