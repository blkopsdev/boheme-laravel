<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="sidebar-wrapper">
    <ul class="nav mt-5">
      @if ($activePanel == 'dashboard')
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('websites') }}">
            <i class="material-icons">laptop</i>
              <p>@lang('app.websites')</p>
          </a>
        </li>
        <li class="nav-item {{ $activePage == 'custom_websites' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('custom_websites') }}">
            <i class="material-icons">laptop</i>
              <p>{{ __('CM Websites') }}</p>
          </a>
        </li>
        <li class="nav-item {{ $activePage == 'webshops' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('webshop.index') }}">
            <i class="material-icons">shopping_cart</i>
              <p>{{ __('app.webshops') }}</p>
          </a>
        </li>
        <li class="nav-item {{ $activePage == 'custom-webshops' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('custom_webshop.index') }}">
            <i class="material-icons">shopping_cart</i>
              <p>{{ __('CM Webshops') }}</p>
          </a>
        </li>

        <hr>
        <li class="nav-item{{ $activePage == 'agenda' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('agenda') }}">
            <i class="material-icons">event_available</i>
            <span class="sidebar-normal"> {{ __('Agenda') }} </span>
          </a>
        </li>
        @if (auth()->user()->is_admin())
        <hr>
        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('show_users') }}">
            <i class="material-icons">group</i>
            <span class="sidebar-normal"> {{ __('Managers') }} </span>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'settings' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('theme_settings') }}">
            <i class="material-icons">settings</i>
            <span class="sidebar-normal"> {{ __('Theme Settings') }} </span>
          </a>
        </li>
        <hr>
        <li class="nav-item{{ $activePage == 'resellers' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('reseller.index') }}">
            <i class="material-icons">supervisor_account</i>
            <span class="sidebar-normal">{{ __('Resellers') }} </span>
          </a>
        </li>
        @endif
      @elseif ($activePanel == 'service_desk')
        <li class="nav-item{{ $activePage == 'open_tickets' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('open_tickets') }}">
            <i class="material-icons">assignment</i>
              <p>@lang('app.open_tickets')</p>
          </a>
        </li>
        <li class="nav-item {{ $activePage == 'closed_tickets' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('closed_tickets') }}">
            <i class="material-icons">task_alt</i>
              <p>{{ __('app.closed_tickets') }}</p>
          </a>
        </li>
      @endif
    </ul>
  </div>
</div>