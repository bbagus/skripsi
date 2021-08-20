@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Pengajuan PKL')
@section('sidebar')
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="logo SMK N 1 Pengasih" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
           @if ($user->foto != 'default.jpg')
          <img src="{{url('/')}}/data_file/{{$user->foto}}" class="img-circle elevation-2 mt-2" alt="Foto Profil">
          @else
          <img src="{{url('/')}}/data_file/siswa-default.jpg" class="img-circle elevation-2 mt-2" alt="Foto Profil">
          @endif
        </div>
        <div class="info" style="padding: 0 5px 0 15px;white-space: normal;">
          <a href="#" class="d-block">{{$user->nama}}<br>
            <sup>{{$user->nis}}</sup>
          </a>
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
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/siswa/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/siswa/profil" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li> 
          <li class="nav-header">Proses PKL</li>  
          <li class="nav-item">
            <a href="/siswa/pengajuan" class="nav-link active">
              <i class="nav-icon fas fa-pencil-alt"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/siswa/bimbingan" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Bimbingan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/siswa/laporan-mingguan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  laporan mingguan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/siswa/laporan-pkl" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  laporan PKL
                  </p>
                </a>
              </li>
              </ul> 
          </li> 
              <li class="nav-item">
                <a href="/siswa/nilai" class="nav-link">
                  <i class="far fa-star nav-icon"></i>
                  <p>
                  Nilai
                  </p>
                </a>
              </li>  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection
@section('content')
Pengajaun
@endsection