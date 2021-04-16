{{-- Tombol Search --}}
{{-- {{dd($role)}} --}}
<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>

<ul class="navbar-nav navbar-right">
    @auth
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            {{-- Profil --}}
            <img alt="image" src="{{asset("storage/images/profile/" . Auth::user()->profile->foto_profil)}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->profile->name}} </div>
            </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="{{route('profile', ['user' => Auth::user()->slug])}}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{route("logout")}}" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        </li>
    @endauth
    @if (!Auth::check())
        <a href="{{route("login")}}" class="text-dark">Login</a>
    @endif
</ul>
