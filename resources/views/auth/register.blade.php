
@extends('layouts.auth-layout')


@section('content')
    <form class="card-body p-5 " method="post" action="{{route('register')}}">
        @csrf
        <h3 class="mb-2 text-center">Sign up</h3>

        <div  class="form-outline mb-2">
            <label class="form-label" for="typeEmailX-2">Name</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>
        <div  class="form-outline mb-2">
            <label class="form-label" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>

        <div  class="form-outline mb-2">
            <label class="form-label" for="typeEmailX-2">Address</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>
        <div  class="form-outline mb-2">
            <label class="form-label" for="typeEmailX-2">phone number</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>

        <div  class="form-outline mb-2">
            <label class="form-label" for="typePasswordX-2">Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>  <div  class="form-outline mb-2">
            <label class="form-label" for="typePasswordX-2">Confirm Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>



        <button  class="btn btn-primary btn-lg btn-block" type="submit">Sign Up</button>

    </form>

@endsection
