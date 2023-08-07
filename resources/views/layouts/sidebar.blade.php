@php
    $usertype = Session::get('usertype');
@endphp
<div class="side--nav">
    <div class="sidenav--top">
        <a href="{{ route('home') }}" class="logo-nav"><img src="{{ asset('/public/images/admin_Logo.png') }}" alt="Catalog"></a>
        <a href="javascript:;" class="hamburger-icon" title="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <div class="side--menu">
        <ul class="menu">
            <li class="current-menu-item"><a href="{{route('home')}}"><span class="menu--icon"><img src="{{ asset('/public/images/dashboard.svg') }}" alt="dashboard"></span>Dashboard</a></li>
            <li class="menu-item-has-children">
                <a href="{{route('users.index')}}"><span class="menu--icon"><img src="{{ asset('/public/images/account.svg') }}" alt="Users"></span>Users</a>
                <ul class="sub-menu">
                    <li @if(Route::current()->getName() == 'users.index' || Route::current()->getName() == 'users.create' || Route::current()->getName() == 'users.edit') class="current-menu-item" @endif><a href="{{route('users.index')}}"><span class="menu--icon"><img src="{{ asset('/public/images/account.svg') }}" alt="Users"></span>Users</a></li>
                </ul>
            </li>
            <!-- <li>                  
                <li @if(Route::current()->getName() == 'users.index' || Route::current()->getName() == 'users.create' || Route::current()->getName() == 'users.edit') class="current-menu-item" @endif><a href="{{route('users.index')}}"><span class="menu--icon"><img src="{{ asset('/public/images/account.svg') }}" alt="Users"></span>Users</a></li>
            </li> -->
        </ul>
    </div>
</div>