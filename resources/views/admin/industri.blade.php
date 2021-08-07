@extends('layout.master')
@section('title', 'SI-PKL : Admin - Data Industri')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-dark">
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="logo SMK N 1 Pengasih" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
  </a>

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
            <a href="{{url('/')}}/admin/" class="nav-link">
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
            <a href="#" class="nav-link">
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
                <a href="/admin/kelola-guru" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru Pembimbing</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item">
            <a href="/admin/kelola-industri" class="nav-link active">
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
            <a href="/admin/kelola-monitoring" class="nav-link">
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
    </aside>
    @endsection
    @section('judul', 'Kelola Data Industri')
    @section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if(count($errors) > 0)
           <div class="alert alert-danger alert-dismissible shadow">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-exclamation-triangle"></i>
            @foreach ($errors->all() as $error)
            {{ $error }} <br/>
            @endforeach
          </div>
          @endif
            @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible shadow">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <i class="icon fas fa-exclamation-triangle"></i>
              {!! \Session::get('success') !!}
            </div>
            @endif
            <!-- /.card -->
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form onSubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data yang ditandai?')" action="{{route('hapus_industri')}}" method="POST">
                {{ csrf_field() }}
              <div class="card-header">
                <h3 class="card-title">
                  <a href="/admin/kelola-industri/tambah" class="btn btn-small btn-success"><i class="fas fa-plus"></i> Tambah Industri</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Nama</th>
                      <th>Bidang Kerja</th>
                      <th>Alamat</th>
                      <th>Wilayah</th>
                      <th>No. Telepon</th>
                      <th>Logo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($industri as $s)
                    <tr>
                      <td style="vertical-align: middle;" width="30px">
                        <div class="icheck-primary">
                        <input type="checkbox" name="hapus[]" value="{{$s->kd_industri}}" id="{{$s->kd_industri}}">
                        <label for="{{$s->kd_industri}}"></label>
                      </div>
                      </td>
                      <td style="vertical-align: middle;">{{ $s->nama }}</td>
                      <td style="vertical-align: middle;">{{ $s->bidang_kerja}}</td>
                      <td style="vertical-align: middle;">{{ $s->alamat}}</td>
                      <td style="vertical-align: middle;">{{ $s->wilayah}}</td>
                      <td style="vertical-align: middle;">{{ $s->telp}}</td>
                      <td style="vertical-align: middle;padding:0.2rem;" width="100px">
                        <img class="img-fluid" src="{{url('/')}}/data_file/{{$s->foto}}" alt="">
                      </td>
                      <td style="vertical-align: middle;" width="160px" >
                        <a href="{{url('/')}}/admin/kelola-industri/{{$s->kd_industri}}" class="btn btn-small btn-success"><i class="fas fa-edit"></i>Edit</a>
                        <a onclick="deleteConfirm('{{url('/')}}/admin/kelola-industri/hapus/{{$s->kd_industri}}')" href="#!" class="btn btn-small btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
             <!-- /.card-body -->
              <div class="card-footer">
                <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-outline-dark btn-small checkbox-toggle"><i class="far fa-square"></i> Tandai Semua
                </button>
                <div class="btn-group">
                  <input type="submit" class="btn btn-danger" value="Hapus">
                </div>
                <!-- /.btn-group -->
                </div>
              </div>
              <!-- /.card-footer -->
            </form>
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
  @section('modal')
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Data yang dihapus tidak bisa dikembalikan.</div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
        </div>
      </div>
    </div>
  </div>
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
    <script>
      $(function () {
   //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('#example1 input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('#example1 input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })
  })
     $(document).ready(function () {
      $("#example1").DataTable({
        "processing": true,
        "columns": [
        { "data": "checkbox"},
        { "data": "nama" },
        { "data": "bidang_kerja" },
        { "data": "alamat" },
        { "data": "wilayah" },
        { "data": "telp" },
        { "data": "foto" },
        { "data": "action"}
        ],
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["colvis", "print", "pdf", "excel"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script>
    function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    }
  </script>
  @endsection