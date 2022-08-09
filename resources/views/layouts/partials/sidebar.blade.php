<?php
// use Illuminate\Support\Facades\Auth;
use Zend\Debug\Debug;

// Debug::dump(auth()->user()->getRelation('roles'));die;
// Debug::dump(auth()->user()->hasRole('admin'));die;

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
    <img src="{!! url('assets/adminlte/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SI<span class="text-danger text-bold">AKSI</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{!! url('assets/adminlte/dist/img/user2-160x160.jpg') !!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline d-none">
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
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/home" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-header">SURAT</li>
        <li class="nav-item">
            <a href="/surat-masuk" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
                Surat Masuk
                <span class="badge badge-info right">2</span>
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/surat-keluar" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
                Surat Keluar
                <span class="badge badge-info right">2</span>
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/arsip" class="nav-link">
            <i class="nav-icon fas fa-archive"></i>
            <p>
                Arsip
            </p>
            </a>
        </li>
        <?php if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) { ?>
        <li class="nav-header">ADMINISTRATION</li>
        <li class="nav-item">
            <a href="/users" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Users
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/roles" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
                Roles
            </p>
            </a>
        </li>
        <?php } if (auth()->user()->hasRole('Super Admin')){ ?>
        <li class="nav-item">
            <a href="/permissions" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
                Permissions
            </p>
            </a>
        </li>
        <?php } ?>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
    <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
    <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
    <!-- /.sidebar-custom -->
</aside>