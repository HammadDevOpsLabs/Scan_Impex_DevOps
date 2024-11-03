@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Create category</h1>
@stop

@section('content_top_nav_left')
    <h1>Create category</h1>
@stop
@section('content')


    <section class="content">
        <div class="container-fluid">

                        <form id="form" class="card" method="post"
                              @if (isset($category))

                                  action="{{route('admin.categories.update',$category->id)}}"
                              @else
                                  action="{{route('admin.categories.store')}}"
                              @endif

                              class="row" enctype="multipart/form-data">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">{{trans('Name')}}</label>
                                            <input type="text" name="name" class="form-control" placeholder="{{trans('Name')}}" value="{{$category->title ??""}}" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">{{trans('Logo')}}</label>
                                            <input type="file" name="logo" class="form-control" placeholder="{{trans('Name')}}"  >
                                        </div>


                                    </div>

                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="card-footer">
                                <button  type="reset" class="btn btn-secondary">{{trans('Reset')}}</button>
                                <button  id="submit" type="submit" class="btn btn-success">{{trans('Submit')}}<i class="fas "></i></button>

                            </div>

                        </form>
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
