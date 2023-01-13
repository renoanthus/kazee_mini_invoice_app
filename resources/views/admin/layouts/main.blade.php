<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  @yield('title')
  @include('admin.layouts.header')
</head>

<body>
  <div id="wrapper">
    <div class="navbar-custom">
      <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <img src="{{asset('/adminto/dist/assets/images/users/user-1.jpg')}}" alt="user-image"
              class="rounded-circle">
            <span class="pro-user-name ml-1">
              {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome {{ Auth::user()->name }}!</h6>
            </div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item notify-item">
                <i class="fe-log-out"></i>
                <span>Logout</span>
              </button>
            </form>
          </div>
        </li>
      </ul>
      <!-- LOGO -->
      <div class="logo-box">
        <a href="{{route('admin.home')}}" class="logo logo-dark text-center">
          <span class="logo-lg">
            <img src="{{asset('/adminto/dist/assets/images/logo-dark.png')}}" height="16" alt=""
              style="transform: scale(1.5)">
          </span>
          <span class="logo-sm">
            <img src="{{asset('/adminto/dist/assets/images/logo-dark.png')}}" height="24" alt=""
              style="transform: scale(1.5)">
          </span>
        </a>
        <a href="{{route('admin.home')}}" class="logo logo-light text-center">
          <span class="logo-lg">
            <img src="{{asset('/adminto/dist/assets/images/logo-light.png')}}" alt="" height="16">
          </span>
          <span class="logo-sm">
            <img src="{{asset('/adminto/dist/assets/images/logo-light.png')}}" alt="" height="24">
          </span>
        </a>
      </div>

      <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
          <button class="button-menu-mobile disable-btn waves-effect">
            <i class="fe-menu"></i>
          </button>
        </li>
        <li>
          @yield('caption')
        </li>
      </ul>

    </div>
    <div class="left-side-menu">
      @include('admin.layouts.sidebar')
    </div>
    <div class="content-page">
      <div class="content">
        @yield('content')
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              2023 - {{ Carbon\Carbon::now()->format('Y') }} &copy; Kazee
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  @include('admin.layouts.footer')
</body>

</html>