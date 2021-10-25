@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Pengajuan PKL')
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
      <a href="/siswa/profil" class="d-block">{{$user->nama}}<br>
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
                <a href="/siswa/laporan-kegiatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan kegiatan
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
  @section('judul', 'Pengajuan PKL')
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
            <h3 class="card-title">
              <a onclick="formPengajuan()" href="#" class="btn btn-small btn-success"><i class="fas fa-plus"></i> Tambah Pengajuan PKL</a>
            </h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Instansi</th>
                  <th>Alamat</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tahun Ajaran</th>
                  <th>Status</th>
                  <th>Tanggal Diproses</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 1; ?>
                @foreach ($pengajuan as $s)
                <tr>
                  <td>{{$count++}}. </td>
                  <td style="vertical-align: middle;">{{ $s->industri}}</td>
                  <td style="vertical-align: middle;">{{ $s->alamat}}</td>
                  <td style="vertical-align: middle;">{{ $s->tgl_pengajuan}}</td>
                  <td style="vertical-align: middle;">{{ $s->tahun_ajaran}}</td>
                  <td style="vertical-align: middle;"width="90px">
                   @if ($s->status == 'Diterima')
                   <span class="btn btn-sm btn-success"> {{ $s->status}}</span>
                   @elseif ($s->status == 'Ditolak')
                   <span class="btn btn-sm btn-danger"> {{ $s->status}}</span>
                   @else
                   <span class="btn btn-sm btn-primary"> {{ $s->status}}</span>
                   @endif
                 </td>
                 <td style="vertical-align: middle;"width="140px">{{ $s->tgl_diproses}}</td>
               </tr>
               @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection
 @section('modal')
 <div class="modal fade" id="formModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:100px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="formpengajuan" class="form-horizontal" action="{{route('tambah_pengajuan')}}" method="POST">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambah Pengajuan PKL</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-3 ml-3 mr-3 mb-3">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="nis" class="col-sm-2 col-form-label">NIS<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nis" value="{{$user->nis}}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Tahun Ajaran<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tahunajaran" value="{{$tahunajaran}}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="livesearch" class="col-sm-2 col-form-label">Nama Instansi<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <select class="form-control livesearch" name="livesearch" style="width: 100%;">
              </select>
            </div>
          </div>
          Detail info instansi bisa cek di <a href="{{url('/')}}/industri" target="_blank" rel="noopener noreferrer"> sini</a>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input class="btn btn-success" type="submit" value="Simpan" >
      </div>
    </form>
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
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
 $(document).ready(function () {
   $(".livesearch").on('select2:open', () => { document.querySelector('.select2-search__field').focus();
 });
   $("#example1").DataTable({
    "processing": true,
    "columns": [
    { "data": "no"},
    { "data": "Instansi" },
    { "data": "Alamat" },
    { "data": "Tanggal Pengajuan" },
    { "data": "Tahun Ajaran" },
    { "data": "Status" },
    { "data": "Tanggal diproses" }
    ],
    "responsive": true, "lengthChange": false, "searching": false, "autoWidth": false,
    "buttons": []
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 });

$.validator.setDefaults({});
 $('#formpengajuan').validate({
  rules: {
    livesearch: {
      required: true,
    },
  },
  messages: {
    livesearch: {
      required: "Instansi harus diisi!",
    },
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  }
});
 function formPengajuan(){
  $('#formModal').modal();
}
</script>
<script type="text/javascript">
  $('.livesearch').select2({
    placeholder: 'Pilih Instansi',
    ajax: {
      url: '/siswa/pengajuan/cari',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nama,
              id: item.kd_industri
            }
          })
        };
      },
      cache: true
    }
  });
</script>
@endsection