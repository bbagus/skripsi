@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
@endsection
@section('head')

@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
@auth
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-dark" >
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="logo SMK N 1 Pengasih" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
  </a>
  @if (Auth::user()->role == 'admin')
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{url('/')}}/data_file/15267-202005.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Administrator</a>
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
            <a href="/admin/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li> 
          <li class="nav-item ">
            <a href="/admin/kelola-informasi" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-siswa" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-guru" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru Pembimbing</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item">
            <a href="/admin/kelola-industri" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Industri
              </p>
            </a>
          </li> 
          <li class="nav-header">Proses PKL</li>  
          <li class="nav-item">
            <a href="/admin/kelola-pengajuan" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kelola-penempatan" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Penempatan
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-binoculars"></i>
              <p>
                Monitoring
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-laporan-mingguan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan mingguan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-laporan-pkl" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan PKL
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-nilai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Nilai
                  </p>
                </a>
              </li>  
            </li>   
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
      @elseif (Auth::user()->role == 'siswa')
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if ($industri->foto != 'default.jpg')
            <img src="{{url('/')}}/data_file/{{$industri->foto}}" class="img-circle elevation-2 mt-2" alt="User Image">
            @else
            <img src="{{url('/')}}/data_file/siswa-default.jpg" class="img-circle elevation-2 mt-2" alt="User Image">
            @endif
          </div>
          <div class="info" style="padding: 0 5px 0 15px;white-space: normal;">
            <a href="#" class="d-block">{{$industri->nama}}<br>
              <sup>{{$industri->nis}}</sup>
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
            <a href="/siswa/pengajuan" class="nav-link">
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
    @elseif (Auth::user()->role == 'guru')
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if ($user->foto != 'default.jpg')
          <img src="{{url('/')}}/data_file/{{$user->foto}}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{url('/')}}/data_file/guru-default.jpeg" class="img-circle elevation-2 mt-2" alt="User Image">
          @endif
        </div>
        <div class="info" style="white-space: normal;">
          <a href="#" class="d-block">{{$user->nama}}</a>
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
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="/guru/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/guru/profil" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li> 
          <li class="nav-header">Proses PKL</li>  
          <li class="nav-item">
            <a href="/guru/siswa-bimbingan" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar Siswa Bimbingan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/guru/bimbingan" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Bimbingan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/guru/laporan-mingguan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan mingguan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/guru/laporan-pkl" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan PKL
                  </p>
                </a>
              </li>
            </ul> 
          </li> 
          <li class="nav-item">
            <a href="/guru/kelola-nilai" class="nav-link">
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
    @endif
    @endauth
  </aside>
  @endsection
  @section('judul', 'Detail Industri')
  @section('content')
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <a onclick="goBack()" href="#"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($industri->foto != 'default.jpg')
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$industri->foto}}"
                alt="Logo Industri" style="min-height:150px;">
                @else
                <img class="img-fluid"
                src="{{url('/')}}/data_file/industri-default.png"
                alt="Logo Industri" style="min-height:150px;">
                @endif
              </div>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"> 
                  
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
             <h3 class="card-title">
                <h3 class="card-title">
                Detail Industri
              </h3>
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content mb-3">
                <div class=" <?php echo count($errors) > 0 ? '': 'active' ?> tab-pane" id="activity">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="col-sm-3">Nama Instansi</td>
                          <td>:</td>
                          <td>{{$industri->nama}} </td>
                        </tr>
                        <tr>
                          <td>Jurusan</td>
                          <td>:</td>
                          <td>{{$industri->jurusan}}</td>
                        </tr>
                        <tr>
                          <td>Bidang Kerja</td>
                          <td>:</td>
                          <td>{{$industri->bidang_kerja}}</td>
                        </tr>
                        <tr>
                          <td>Deskripsi Instansi</td>
                          <td>:</td>
                          <td>{{$industri->deskripsi}}</td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td>:</td>
                          <td>{{$industri->alamat}}</td>
                        </tr>
                        <tr>
                          <td>Nama Kontak</td>
                          <td>:</td>
                          <td>{{$industri->nama_kontak}}</td>
                        </tr>
                        <tr>
                          <td>No. Telp</td>
                          <td>:</td>
                          <td>{{$industri->telp}}</td>
                        </tr>
                       <tr>
                          <td>Website</td>
                          <td>:</td>
                          <td>{{$industri->website}}</td>
                        </tr>
                        <tr>
                          <td>email</td>
                          <td>:</td>
                          <td>{{$industri->email}}</td>
                        </tr>
                         <tr>
                          <td>Kuota yang disediakan</td>
                          <td>:</td>
                          <td>{{$industri->kuota}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
  @endsection
@section('javascript')
<script>
function goBack() {
  window.history.back();
}
</script>
 @endsection