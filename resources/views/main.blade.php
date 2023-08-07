<!DOCTYPE html>
<html lang="en">
<head>
@include("layouts.head")
</head>
<body>
    @if (Auth::check())
        @include("layouts.header")
        @include("layouts.sidebar")
    @endif    

    @yield('content')

@include("layouts.footer")
@yield('footersec')
</body>
</html>
 