
@extends('layouts.auth-layout')


@section('content')

    <form method="POST" action="{{ route('login') }}" class="card-body p-5 text-center">

        @csrf
        <h3 class="mb-5">Sign in</h3>

        <div  class="form-outline mb-4">
            <label class="form-label" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
        </div>

        <div  class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">Password</label>
            <input type="password" id="typePasswordX-2" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
        </div>



        <button  class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <div class="row">
            <div class="col-12 mt-1"> <a href="{{ route('password.request') }}">I forgot my password</a></div>
            <div class="col-12 mt-2">Don't have an account? <a href="{{route('register')}}">Sign Up</a></div>
        </div>


    </form>
@endsection
