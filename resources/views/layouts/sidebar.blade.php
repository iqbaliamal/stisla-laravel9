<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="/admin"><i class="fas fa-fire"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i>
          <span>Users</span>
        </a>
      </li>
      <li class="dropdown">
        <a class="nav-link has-dropdown" href="#"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="errors-503.html">503</a></li>
          <li><a class="nav-link" href="errors-403.html">403</a></li>
          <li><a class="nav-link" href="errors-404.html">404</a></li>
          <li><a class="nav-link" href="errors-500.html">500</a></li>
        </ul>
      </li>
    </ul>

    <div class="hide-sidebar-mini mt-4 mb-4 p-3">
      <a class="btn btn-primary btn-lg btn-block btn-icon-split" href="https://getstisla.com/docs">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div>
  </aside>
</div>
