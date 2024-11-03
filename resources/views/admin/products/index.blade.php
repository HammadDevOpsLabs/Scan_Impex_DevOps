@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content_top_nav_left')
    <h1>Categories</h1>
@stop
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body">

                            <div>

                                <table class="table table-striped table-bordered text-center text-nowrap" id="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('#')</th>
                                        <th>@lang('Name')</th>
                                        <th width="10%">@lang('Actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products ?? [] as $product)

                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->title}}</td>
                                        <td>
                                            <a href="{{route('admin.products.edit',$products->slug)}}">Edit</a>
                                        </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        </tr>
                                </table>
                                {{$categories->links()}}

                            </div>
                        </div>
                        <div class="card-footer text-right">
                                <a href="{{route('admin.categories.create',)}}" class="btn btn-primary text-right">@lang('create') <i class="fa fa-plus"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
