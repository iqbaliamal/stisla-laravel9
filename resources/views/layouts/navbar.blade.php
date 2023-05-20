<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a class="nav-link nav-link-lg" data-toggle="sidebar" href="#"><i class="fas fa-bars"></i></a></li>
      <li><a class="nav-link nav-link-lg d-sm-none" data-toggle="search" href="#"><i class="fas fa-search"></i></a>
      </li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-toggle="dropdown"
        href="#">
        <img class="rounded-circle mr-1"
          src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/img/avatar/avatar-1.png') }}"
          alt="image">
        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->first_name }}</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item has-icon" href="features-profile.html">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item has-icon text-danger" href="javascript:void();"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" style="display: none;" action="{{ route('logout') }}" method="POST">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>
