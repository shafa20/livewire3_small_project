<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Livewire 3 Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text">
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('todo.list')
                <li class="nav-item">
                    <a href="{{ route('todo') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt text-primary"></i>
                        <p class="text">Todo</p>
                    </a>
                </li>
                @endcan

                @can('unlimited_manue_sub.list')
                <li class="nav-item">
                    <a href="{{ route('manues')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p class="text"> Unlimited manue & sub </p>
                    </a>
                </li>
                @endcan

                @can('student.list')
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap text-success"></i>
                        <p class="text">Students</p>
                    </a>
                </li>
                @endcan

                @can('brand.list')
                <li class="nav-item">
                    <a href="{{ route('brands') }}" class="nav-link">
                        <i class="nav-icon fas fa-building text-danger"></i>
                        <p class="text">Brand</p>
                    </a>
                </li>
                @endcan

                @can('model.list')
                <li class="nav-item">
                    <a href="{{ route('models') }}" class="nav-link">
                        <i class="nav-icon fas fa-car text-warning"></i>
                        <p>Model</p>
                    </a>
                </li>
                @endcan

                @can('item.list')
                <li class="nav-item">
                    <a href="{{ route('items') }}" class="nav-link">
                        <i class="nav-icon fas fa-cube text-info"></i>
                        <p>Item</p>
                    </a>
                </li>
                @endcan

                @can('user.list')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user text-info"></i>
                        <p>User</p>
                    </a>
                </li>
                @endcan

                @can('role.list')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users text-warning"></i>
                        <p>Role</p>
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
