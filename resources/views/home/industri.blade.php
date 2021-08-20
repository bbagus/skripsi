@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
@endsection
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
          @if ($user->foto != 'default.jpg')
          <img src="{{url('/')}}/data_file/{{$user->foto}}" class="img-circle elevation-2 mt-2" alt="User Image">
          @else
          <img src="{{url('/')}}/data_file/siswa-default.jpg" class="img-circle elevation-2 mt-2" alt="User Image">
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
@section('content')
<section class="content">
      <div class="container-fluid">
        <h2 class="text-center display-4 mb-3">Daftar Industri</h2>
        <div class="callout callout-info bg-gradient-info col-md-10 offset-md-1">
           <h5 class="text-center col-md-10 offset-md-1 p-3">Berikut merupakan daftar industri atau instansi tempat PKL. Anda dapat menemukan informasi seputar tempat industri, bidang kerja, kuota yang disediakan, dan lain lain.</h5>
          <p >
        </p>
            <form action="/industri/c" method="GET">
              
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Filter Berdasarkan :</label>
                                    <select class="select2" name="k"  id="first-choice" data-placeholder="Any" style="width: 100%;">
                                       <option selected disabled>Pilih filter</option>
                                       <option value="jurusan">Jurusan</option>
                                        <option value="bidang_kerja">Bidang kerja</option>
                                        <option value="wilayah">Wilayah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="filter" id="filter">Pilih :</label>
                                    <select class="select2" id="second-choice" multiple="multiple" name="f" style="width: 100%;" data-placeholder="any">
                                        <option disabled value="iki value">Pilih filter dahulu</option>
                                    </select>
                                     <input type="hidden" name="test" id="test">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" name="kk" class="form-control form-control-lg" placeholder="Atau cari berdasarkan nama instansi">
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                           <button type="submit" class="btn btn-lg btn-default">
                              Cari &nbsp;<i class="fa fa-search"></i>
                          </button>
                           @if (isset($teks))
                          <button onclick="window.location.href='/industri';" class="btn btn-lg btn-default ml-2">reset filter &nbsp;<i class="fa fa-sync-alt"></i>
                          </button>
                          @endif
                        </div>
                    </div>
                </div>
            </form>
          </div>
           @if (isset($teks))
           <h3 class="text-center mt-5">{{$teks}}
           </h3> 
           @else
           <h2 class="text-center mt-5"></h2>
           @endif

        <div class="row">
          <div class="col-md-10 offset-md-1 mt-3">
            <!-- /.card -->
            <div class="card card-primary card-outline">
              <!-- form start -->
                {{ csrf_field() }}
              <div class="card-header">
                <h3 class="card-title">

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Logo</th>
                      <th>Nama</th>
                      <th>Jurusan</th>
                      <th>Bidang Kerja</th>
                      <th>Wilayah</th>
                      <th>Nama Kontak</th>
                      <th>No. Telepon</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1; ?>
                    @foreach ($industri as $s)
                    <tr>
                      <td>{{$count++}}. </td>
                      <td style="vertical-align: middle;padding:0.2rem;" width="100px">
                        <img class="img-fluid" src="{{url('/')}}/data_file/{{$s->foto}}" alt="">
                      </td>
                      <td style="vertical-align: middle;">{{ $s->nama }}</td>
                      <td style="vertical-align: middle;">{{ $s->jurusan }}</td>
                      <td style="vertical-align: middle;">{{ $s->bidang_kerja}}</td>
                      <td style="vertical-align: middle;">{{ $s->wilayah}}</td>
                      <td style="vertical-align: middle;">{{ $s->nama_kontak}}</td>
                      <td style="vertical-align: middle;">{{ $s->telp}}</td>
                      <td style="vertical-align: middle;text-align: center;" width="80px" >
                        <a href="{{url('/')}}/industri/{{$s->kd_industri}}" class="btn btn-small btn-primary">Detail</a>
                        
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
             <!-- /.card-body -->
              <div class="card-footer">
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection
@section('javascript')
<!-- DataTables  & Plugins -->
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/dataTables.buttons.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/pdfmake.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/vfs_fonts.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.html5.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.print.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.colVis.min.js">
</script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
   $(function () {
    bsCustomFileInput.init();
     //Initialize Select2 Elements
     $('.select2').select2()
     //Initialize Select2 Elements
     $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
   });
  $(document).ready(function () {
    $("#example1").DataTable({
      "processing": true,
      "columns": [
      { "data": "no" },
      { "data": "foto" },
      { "data": "nama" },
      { "data": "jurusan" },
      { "data": "bidang_kerja" },
      { "data": "wilayah" },
      { "data": "nama_kontak" },
      { "data": "telp" },
      { "data": "action"}
      ],
      "responsive": true, "lengthChange": true, "autoWidth": false,"searching": false,
      "buttons": ["colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $("#first-choice").change(function() {
  var $dropdown = $(this);
  $.getJSON("{{url('/')}}/data_file/filter.json", function(data) {
    var key = $dropdown.val();
    var vals = [];      
    switch(key) {
      case 'bidang_kerja':
        vals = data.bidang_kerja.split(",");
         document.getElementById('filter').innerHTML
                = 'Pilih Bidang kerja :';
        break;
      case 'wilayah':
        vals = data.wilayah.split(",");
        document.getElementById('filter').innerHTML
                = 'Pilih Wilayah :';
        break;
      case 'jurusan' :
        vals = data.jurusan.split(",");
        document.getElementById('filter').innerHTML
                = 'Pilih Jurusan :';
        break;
      case 'base':
        vals = ['Please choose from above'];
    }
    
    var $secondChoice = $("#second-choice");
    $secondChoice.empty();
    $.each(vals, function(index, value) {
      $secondChoice.append("<option value='"+ value + "'>" + value + "</option>");
    });
  });
});
$(function(){
  // turn the element to select2 select style
  $('#second-choice').on('change', function(e) {
    var data = $("#second-choice").val();
    $("#test").val(data);
  });
});
</script>
@endsection