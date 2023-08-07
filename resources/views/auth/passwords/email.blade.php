@extends('main')

@section('content')
<div class="full--wrapper d-flex flex-wrap align-center">
    <div class="vertical--center-wrapper d-flex flex-wrap justify-center">
        <div class="container">
            <div class="logo">
                <a href="#"><img src="{{ asset('/public/images/logo/admin_Logo.png') }}" alt="Naptune"></a>
            </div>
            <div class="login--form-block">
                <div class="title">
                    <span class="h3">Enter your email address to reset your user password.</span>
                </div>
                @if (session('status'))
                    <div class="alert alert-success text-center mt-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @error('email')
                    <div class="alert alert-danger text-center mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                
                <form class="mt-4" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <input placeholder="Email Address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="bottom--form text-center">
                        <button type="submit" class="btn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
