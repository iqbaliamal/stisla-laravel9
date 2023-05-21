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
      <li class="{{ request()->is('admin/articles') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.articles.index') }}"><i class="fas fa-post"></i>
          <span>Artikel</span>
        </a>
      </li>
      <li class="dropdown">
        <a class="nav-link has-dropdown" href="#"><i class="fas fa-users"></i> <span>Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.users.index') }}">Admin</a></li>
          <li><a class="nav-link" href="{{ route('admin.penulis.index') }}">Penulis</a></li>
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
