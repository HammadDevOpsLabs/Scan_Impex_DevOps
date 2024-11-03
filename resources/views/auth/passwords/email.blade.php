
@extends('layouts.auth-layout')


@section('content')
                    <form method="POST" action="{{ route('password.email') }}" class="card-body p-5 text-center">
                        @csrf
                        <h3 class="mb-5">Reset Password
                        </h3>

                        <div  class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>

                    </form>

@endsection

@push('js')
    <script>
        @error('email')
        toastr.error('{{$message}}')
        @enderror


        @if (session('status'))
        toastr.success('{{session('status')}}')
        @endif
    </script>
@endpush

