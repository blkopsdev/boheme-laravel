<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-fixed fixed-top ">
  <div class="container-fluid">
    <div class="col-md-3">
      <a href="{{route('home')}}"><img src="{{ asset(auth()->user()->company->logo ) }}" alt="Dashboard" height="50"></a>
    </div>
    <div class="navbar-wrapper">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $activePanel == 'service_desk' ? 'text-success' : '' }}" href="{{ route('service_desk') }}">
            @lang('app.service_desk')
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link{{ $activePanel == 'dashboard' ? ' text-success' : '' }}" href="{{ route('home') }}">
            @lang('app.project_management')
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            @lang('app.drop_your_job')
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            @lang('app.reports')
          </a>
        </li>
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control" placeholder="Search...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            @if ($new_notfs && $new_notfs->count() > 0)
            <span class="notification">{{$new_notfs->count()}}</span>
            @endif
            <p class="d-lg-none d-md-block">
              {{ __('Some Actions') }}
            </p>
          </a>
          @if ($notifications->count() > 0)
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            @foreach ($notifications as $notification)
            @if ($notification->type == 0)
            <a class="dropdown-item {{ $notification->is_read == 0 ? 'font-weight-bold' : '' }}" href="{{ $notification->project->space == 0 ? route('website', $notification->project->id) : route('custom_website', $notification->project->id) }}" data-id="{{ $notification->id }}">{{ $notification->project->project_name }} ({{ $notification->status->name }}) need to be finished in 24 hours</a>
            @endif
            @endforeach
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center" href="{{ route('notifications') }}">@lang('app.all_notifications')</a>
          </div>
          @else
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <p class="dropdown-item">@lang('app.no_notification')</p>
          </div>
          @endif
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('app.account') }}
            </p>
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
@push('js')
<script>
  $(document).ready(function() {
    $('#navbarDropdownMenuLink').click(function() {
      $.ajax({
        url: '{{ route("notification_quick_update") }}',
        type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: '{{ $lUser->id }}'
          },
          success: function(data){
            $('.notification').remove();
          }
      });
    });
    
    $('.dropdown-item.font-weight-bold').click(function() {
      var id = $(this).data('id');
      $.ajax({
        url: '{{ route("notification_read") }}',
        type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            id: id
          },
          success: function(data){
            $('.dropdown-item[data-id="'+id+'"]').removeClass('font-weight-bold');
          }
      });
    });
  })
</script>
@endpush