@extends('layout.master')
@section('title', 'SI-PKL : Admin - Penempatan')
@section('head')
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-dark">
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="Logo SIPKL" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     <div class="image">
      @if ($user->foto != 'default.jpg')
      <img src="{{url('/')}}/data_file/{{$user->foto}}" class="img-circle elevation-2" alt="Foto Profil">
      @else
      <img src="{{url('/')}}/data_file/guru-default.jpeg" class="img-circle elevation-2" alt="Foto Profil">
      @endif
    </div>
    <div class="info">
      <a href="/admin/profil" class="d-block">{{$user->nama}}</a>
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
          <a href="/admin/" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Kelola Data</li>  
        <li class="nav-item">
          <a href="/admin/kelola-informasi" class="nav-link ">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Pengumuman
            </p>
          </a>
        </li> 
        <li class="nav-item">
          <a href="/admin/kelola-informasi" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Pengguna
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/kelola-siswa" class="nav-link">
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
          <a href="/admin/kelola-penempatan" class="nav-link active">
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
              <a href="/admin/kelola-laporan-kegiatan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  laporan kegiatan
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
  @section('judul', 'Kelola Penempatan')
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
           <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? '': 'active' ?>" href="#activity" data-toggle="tab">Lihat berdasarkan Siswa</a></li>
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? 'active': '' ?>" href="#settings" data-toggle="tab">Lihat berdasarkan Guru Pembimbing</a></li>
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? 'active': '' ?>" href="#settings" data-toggle="tab">Lihat berdasarkan Industri</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content mb-3">
                <div id="activity">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Instansi</th>
                    <th>Alamat</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($penempatan as $s)
                  <tr>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"width="160px">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
       </div>
     </div>
   </div>
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
        $('#example2 input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('#example2 input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })
  })
  $(document).ready(function () {
    $("#example1").DataTable({
      "processing": true,
      "columns": [
      { "data": "NIS"},
      { "data": "Nama"},
      { "data": "Instansi" },
      { "data": "Alamat" },
      { "data": "Tanggal Pengajuan" },
      { "data": "Tahun Ajaran" },
      { "data": "Action" }
      ],
      "responsive": true, "lengthChange": true, "searching": true, "autoWidth": false,
      "buttons": []
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });

  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>
@endsection