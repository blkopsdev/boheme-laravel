<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-fixed fixed-top ">
  <div class="container-fluid">
    <div class="col-md-3">
      <a href="/" class="h3 text-warning"><img src="{{ asset('assets/img/Logo.png') }}" alt="" height="50" class="mr-3"> Trade-In Database </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      {{-- <form class="navbar-form">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control" placeholder="Search...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form> --}}
      <ul class="navbar-nav">
        {{-- <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            <span class="notification">5</span>
            <p class="d-lg-none d-md-block">
              {{ __('Some Actions') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">{{ __('Mike John responded to your email') }}</a>
            <a class="dropdown-item" href="#">{{ __('You have 5 new tasks') }}</a>
            <a class="dropdown-item" href="#">{{ __('You are now friend with Andrew') }}</a>
            <a class="dropdown-item" href="#">{{ __('Another Notification') }}</a>
            <a class="dropdown-item" href="#">{{ __('Another One') }}</a>
          </div>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            {{ auth()->user()->name }}
            {{-- <p class="d-lg-none d-md-block">
              {{ __('app.account') }}
            </p> --}}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            {{-- <a class="dropdown-item" href="#">{{ __('Settings') }}</a> --}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('app.logout') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
