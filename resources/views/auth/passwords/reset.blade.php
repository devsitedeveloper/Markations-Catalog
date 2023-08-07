@extends('main')

@section('content')
<div class="full--wrapper d-flex flex-wrap align-center">
    <div class="vertical--center-wrapper d-flex flex-wrap justify-center">
        <div class="container">
            <div class="logo">
                <a href="#"><img src="{{ asset('/public/images/logo/admin_Logo.png') }}" alt="Catalog System"></a>
            </div>
            <div class="login--form-block">
                <div class="title">
                    <span class="h3">Reset Password</span>
                </div>
                
                <form class="mt-4" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-3">
                        <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
