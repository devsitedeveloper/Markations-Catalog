<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="description" content="">
<meta name="author" content="">
<title>Login | Catalog System</title>
<link rel="icon" href="{{ asset('/public/images/logo/admin_favicon.png' ) }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('/public/css/slick.css')  }}">
<link rel="stylesheet" href="{{ asset('/public/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/bootstrap.min.css')}} ">
<link href="{{ asset('/public/scss/style.css') }}" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="full--wrapper d-flex flex-wrap align-center">
        <div class="vertical--center-wrapper d-flex flex-wrap justify-center">
            <div class="container">
                <div class="logo">
                    <a href="#"><img src="{{ asset('/public/images/logo/admin_Logo.png')}}" alt="Catalog"></a>
                </div>
                <div class="login--form-block">
                    <div class="title">
                        <span class="h3">Sign in to your account</span>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger text-center mt-3" role="alert">
                        Invalid Username And Password
                    </div>
                    @endif
                    <form class="mt-4 login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Username / Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="bottom--form d-flex justify-between align-center">
                            <button type="submit" class="btn">Sign In</button>
                            <a href="{{ route('password.request') }}" class="white-text">Forgot Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

 