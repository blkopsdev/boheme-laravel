<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="sidebar-wrapper">
    <ul class="nav mt-5">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="material-icons">laptop</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class="nav-item @if (strpos($activePage, 'customer') !== false) echo ' active'; @endif">
        <a class="nav-link" data-toggle="collapse" href="#navbar-customers" aria-expanded="true">
          <i class="material-icons">groups</i>
          <p>{{ __('Customers') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="navbar-customers">
          <ul class="nav">
						<li class="nav-item{{ $activePage == 'customers.create' ? ' active' : '' }}">
							<a class="nav-link" href="{{ route('customers.create') }}">
								<i class="material-icons">add</i>
								<span class="sidebar-normal"> {{ __('New Customer') }} </span>
							</a>
						</li>
            <li class="nav-item{{ $activePage == 'customers' ? ' active' : '' }}">
							<a class="nav-link" href="{{ route('customers.index') }}">
								<span class="sidebar-mini"> C </span>
								<span class="sidebar-normal"> {{ __('Customer Index') }} </span>
							</a>
						</li>
						
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'transactions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('transactions.index') }}">
          <i class="material-icons">payments</i>
          <p>{{ __('Transactions') }}</p>
        </a>
      </li>
      @if (auth()->user()->user_type == 'admin')
      <li class="nav-item{{ $activePage == 'reports' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('reports') }}">
          <i class="material-icons">attach_money</i>
          <p>{{ __('Reports') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'available_credits' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('available_credits') }}">
          <i class="material-icons">account_balance</i>
          <p>{{ __('Store Credit') }}</p>
        </a>
      </li>
          
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="material-icons">group</i>
          <p>{{ __('User Management') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'settings' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('settings') }}">
          <i class="material-icons">settings</i>
          <p>{{ __('Settings') }}</p>
        </a>
      </li>
      @endif

      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">account_box</i>
          <p>{{ __('Profile') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>