
@extends('layouts.auth-layout')


@section('content')
    <form  method="POST" action="{{ route('password.update') }}" class="card-body p-5 text-center">
        @csrf
        <h3 class="mb-5">Reset Password</h3>

        <input type="hidden" name="token" value="{{ $token }}">

        <div  class="form-outline mb-4">
            <label class="form-label" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
        </div>

        <div  class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        </div>
        <div  class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>



        <button  class="btn btn-primary btn-lg btn-block" type="submit">Reset password</button>
    </form>
@endsection
