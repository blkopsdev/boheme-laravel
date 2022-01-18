<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-relative fixed-top">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand p-0 d-flex align-items-center" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png')}}" alt="IQ Script" height="40"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('add_ticket') }}" class="nav-link">
            <i class="material-icons text-success">support_agent</i> {{ __('Service desk') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->