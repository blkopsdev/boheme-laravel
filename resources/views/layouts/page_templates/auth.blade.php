<div class="wrapper ">
  @include('layouts.navbars.navs.auth')
  <div class="main-panel">
    {{-- @include('flash_msg') --}}
    @include('layouts.navbars.sidebar')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>