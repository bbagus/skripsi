@extends('layout.master')
@section('title', 'SI-PKL : Guru - Edit Profil')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
          <a href="#" class="d-block">{{$user->nama}}<br>
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
            <a href="/guru/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/guru/profil" class="nav-link active">
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
    <!-- /.sidebar -->
  </aside>
@endsection
  @section('judul', 'Edit Profil')
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
                <a href="/guru/profil/"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($user->foto != 'default.jpg')
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$user->foto}}"
                alt="User profile picture" style="min-height:150px;">
                @else
                <img class="img-fluid"
                src="{{url('/')}}/data_file/guru-default.jpeg"
                alt="User profile picture" style="min-height:150px;">
                @endif
              </div>
              <ul class="list-group list-group-unbordered mb-3" style="text-align: center;">
                <li class="list-group-item"> 
                  <a href="/guru/profil/hapus-foto" class="btn btn-dark"><i class="fa fa-trash-alt"></i> Hapus Foto</a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">
                Form
              </h3>
            </div><!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" id="formedit" action="{{url('/')}}/guru/profil/edit-akun" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-body" style="padding: 1.75rem 3rem;">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="username" placeholder="Tulis username.." maxlength="15" value="{{$user->username}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." maxlength="50" value="{{$user->nama}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" placeholder="Tulis NIP.." maxlength="25" value="{{$user->nip}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." maxlength="20" value="{{$user->telp}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Tulis email.." value="{{Auth::user()->email}}" maxlength="50" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" name="jurusan" style="width: 100%;">
                        <option selected="" value="{{$user->jurusan}}">{{$user->jurusan}}</option>
                        <option value="Akuntansi Keuangan dan Lembaga">Akuntansi Keuangan dan Lembaga</option>
                        <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                        <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                        <option value="Perhotelan">Perhotelan</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Tata Busana">Tata Busana</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="wilayah" class="col-sm-2 col-form-label">Wilayah</label>
                    <div class="col-sm-10">
                      <input type="text" name="wilayah" class="form-control" placeholder="Tulis wilayah.." maxlength="50" value="{{$user->wilayah}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
                      @if($user->foto != 'default.jpg')

                      @else
                      <input type="hidden" name="hapus" value="hapus" />
                      @endif
                      <div class="custom-file">
                      <input class="custom-file-input" type="file" name="foto" accept="image/png, image/jpeg" id="customFile" >
                     <label class="custom-file-label" for="customFile">Pilih file</label>
                      <font color="red">
                        Ukuran file maksimal 700 KB.<br>
                        Format file : jpg, jpeg, png.
                      </font>
                    </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="padding: .75rem 5rem;">
                  <input type="submit" class="btn btn-success" value="Simpan">
                  &nbsp;
                  <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
                </div>
              <!-- /.card-footer -->
            </form>
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
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
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
 $.validator.setDefaults({});
 $('#formedit').validate({
  rules: {
    passlama: {
      required: true,
       minlength: 8,
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
      minlength: "Password baru minimal 8 karakter!",
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
});
  function myFunction() {
    document.getElementById("formedit").reset();
  }
</script>
@endsection