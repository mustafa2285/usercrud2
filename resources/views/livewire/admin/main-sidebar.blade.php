<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> @if (Auth::check()) {{Auth::user()->name}} @endif</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kullanıcılar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('article')}}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                MAKALELER
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a wire:click="userLogout" href="#" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Çıkış
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
