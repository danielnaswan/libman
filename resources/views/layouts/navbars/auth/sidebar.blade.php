<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 text-xxs font-weight-bold">UTHM Library Management System</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Management</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('books') ? 'active' : '') }}" href="{{ url('books') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-book text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Books</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('members') ? 'active' : '') }}" href="{{ url('members') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-users text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Members</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('reservations') ? 'active' : '') }}" href="{{ url('reservations') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar-check text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Reservations</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('fines') ? 'active' : '') }}" href="{{ url('fines') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-money-bill-wave text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">Fines</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('user-profile') || Request::is('2fa') ? 'active' : '') }} " href="{{ url('user-profile') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-circle text-dark text-sm"></i>
          </div>
          <span class="nav-link-text ms-1">User Profile</span>
        </a>
      </li>
    </ul>
  </div>
</aside>