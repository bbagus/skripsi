@extends('layout.master')
@section('title')
SI-PKL : Admin - Detail pengajuan 
@endsection
@section('head')
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link">
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="ogo SMK N 1 Pengasih" class="brand-image img-circle elevation-3" style="opacity: .8">
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
      <div class="info" style="white-space: normal;">
        <a href="/admin/profil" class="d-block">{{$user->nama}}<br>
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
    @section('judul', 'Detail Pengajuan')
    @section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
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
        </div>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <a href="/admin/kelola-pengajuan"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div class="card-body box-profile">
              <div class="text-center mb-3">
                @if ($siswa->foto != 'default.jpg')
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$siswa->foto}}"
                alt="User profile picture" style="min-height:140px;">
                @else
                <img class="img-fluid"
                src="{{url('/')}}/data_file/siswa-default.jpg"
                alt="User profile picture" style="min-height:140px;">
                @endif
              </div>
              <table class="table table-hover table-striped">
                <tbody>
                  <tr>
                    <td>Nama Siswa</td>
                    <td>:</td>
                    <td>{{$siswa->nama}} </td>
                  </tr>
                  <tr>
                    <td>Instansi yang Diajukan</td>
                    <td>:</td>
                    <td>{{$industri->nama??'-'}}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>:</td>
                    <td>{{$pengajuan->tgl_pengajuan}}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Diproses</td>
                    <td>:</td>
                    <td>{{$pengajuan->tgl_diproses}}</td>
                  </tr>
                  <tr>
                    <td>Tahun Ajaran</td>
                    <td>:</td>
                    <td>{{$tahunajaran}}</td>
                  </tr>
                </tbody>
              </table>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item text-center mr-4">
                  @if($pengajuan->status == 'Menunggu')
                  <form method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$pengajuan->kd_pengajuan}}" name="kd">
                    <button type="submit" formaction="{{route('terima')}}" class="btn btn-small btn-success mr-4"><i class="fas fa-check"></i> Terima</button>
                    <button type="submit"  formaction="{{route('tolak')}}" class="btn btn-small btn-danger ml-4"><i class="fas fa-times"></i> Tolak</button>
                  </form>
                  @elseif($pengajuan->status == 'Diterima')
                  <button class="btn btn-small btn-success mr-4"><i class="fas fa-check"></i> Diterima</button>
                  @else
                  <button class="btn btn-small btn-danger mr-4"><i class="fas fa-times"></i> Ditolak</button>
                  @endif
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
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail Siswa</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Detail Instansi</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content mb-3">
                <div class=" <?php echo count($errors) > 0 ? '': 'active' ?> tab-pane" id="activity">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                     <tbody>
                      <tr>
                        <td class="col-sm-3">Nama Lengkap</td>
                        <td>:</td>
                        <td>{{$siswa->nama}} </td>
                      </tr>
                      <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{$siswa->nis}}</td>
                      </tr>
                      <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{$siswa->kelas}}</td>
                      </tr>
                      <tr>
                        <td>Jurusan</td>
                        <td>:</td>
                        <td>{{$siswa->jurusan}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{$siswa->tgl_lahir}}</td>
                      </tr>
                      <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td>{{$siswa->telp}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td style="max-width:850px;">{{$siswa->alamat}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="<?php echo count($errors) > 0 ? 'active': '' ?> tab-pane" id="settings">
               <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                 <tbody>
                  @if($industri != null)
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
                    <td style="max-width:850px;">{{$industri->deskripsi}}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="max-width:850px;">{{$industri->alamat}}</td>
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
                  @else
                  <tr>
                    <td>Belum mengajukan instansi</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    @if($industri != null)
    <div class="card card-orange">
      <div class="card-header">
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
          <h3 class="card-title text-white">
             Kuota
          </h3>
        </div>
        <div class="card-body" style="padding: 1.75rem 1.75rem;">
          <p class="text-justify">
           {{$industri->nama}} masih bisa menerima &nbsp; : &nbsp; {{$industri->kuota - $count}} siswa.
          </p>
        </div>
        <!-- /.card -->
      </div>
    @endif
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('modal')
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Ganti Password</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="formpassword" action="{{route('admin_password')}}" method="POST">
       {{ csrf_field() }}
       <div class="modal-body">
        <div class="form-group">
          <label for="passlama" class="col-form-label">Password lama<strong class="text-danger">*</strong></label>
          <input type="password" class="form-control" name="passlama" id="passlama">
        </div>
        <div class="form-group">
          <label for="password_baru" class="col-form-label">Password baru<strong class="text-danger">*</strong></label>
          <input type="password" class="form-control" name="password_baru" id="password_baru">
          <font>
            minimal 8 karakter
          </font>
        </div>
        <div class="form-group">
          <label for="konfirm_password_baru" class="col-form-label">Ulangi password baru<strong class="text-danger">*</strong></label>
          <input type="password" class="form-control" name="konfirm_password_baru" id="konfirm_password_baru">
        </div>
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
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
 $.validator.setDefaults({});
 $('#formpassword').validate({
  rules: {
    passlama: {
      required: true,
    },
    password_baru: {
      required: true,
      minlength: 8,
    },
    konfirm_password_baru: {
      required: true,
      minlength: 8,
    },
  },
  messages: {
    passlama: {
      required: "Password lama harus diisi!",
    },
    password_baru: {
      required: "Password baru harus diisi!",
      minlength: "Password baru minimal 8 karakter!",
    },
    konfirm_password_baru: {
      required: "Password baru harus diisi!",
      minlength: "Password baru minimal 8 karakter!"
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
 function ubahPassword(){
  $('#passwordModal').modal();
}
function goBack() {
  window.history.back();
}
</script>
@endsection