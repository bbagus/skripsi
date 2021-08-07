@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Profil')
@section('head')
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
            <a href="/siswa" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/siswa/profil" class="nav-link active">
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
  </aside>
  @endsection
  @section('judul', 'Profil Siswa')
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
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($user->foto != 'default.jpg')
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$user->foto}}"
                alt="User profile picture" style="min-height:150px;">
                @else
                <img class="img-fluid"
                src="{{url('/')}}/data_file/siswa-default.jpg"
                alt="User profile picture" style="min-height:150px;">
                @endif
              </div>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"> 
                  <a href="#" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Perbarui Akun</a>
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
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? '': 'active' ?>" href="#activity" data-toggle="tab">Biodata</a></li>
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? 'active': '' ?>" href="#settings" data-toggle="tab">Pengaturan akun</a></li>
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
                          <td>{{$user->nama}} </td>
                        </tr>
                        <tr>
                          <td>NIS</td>
                          <td>:</td>
                          <td>{{$user->nis}}</td>
                        </tr>
                        <tr>
                          <td>Kelas</td>
                          <td>:</td>
                          <td>{{$kelas->nama}}</td>
                        </tr>
                        <tr>
                          <td>Jurusan</td>
                          <td>:</td>
                          <td>{{$kelas->jurusan}}</td>
                        </tr>
                        <tr>
                          <td>Tanggal Lahir</td>
                          <td>:</td>
                          <td>{{date('d F Y', strtotime($user->tgl_lahir))}}</td>
                        </tr>
                        <tr>
                          <td>No. Telp</td>
                          <td>:</td>
                          <td>{{$user->telp}}</td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td>:</td>
                          <td>{{$user->alamat}}</td>
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
                      <tr>
                        <td class="col-sm-3">Username</td>
                        <td>:</td>
                        <td>{{Auth::user()->username}} </td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{Auth::user()->email}}</td>
                      </tr>
                      <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><a onclick="ubahPassword()" href="#">Ubah Password</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
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
      <form id="formpassword" action="{{route('ganti_password')}}" method="POST">
       {{ csrf_field() }}
       <input type="hidden" name="nis" value="{{$user->nis}}">
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
       minlength: 8,
    },
    passbaru: {
      required: true,
      minlength: 8,
    },
    passbarulagi: {
      required: true,
      minlength: 8,
    },
  },
  messages: {
    passlama: {
      required: "Password lama harus diisi!",
      minlength: "Password baru minimal 8 karakter!",
    },
    passbaru: {
      required: "Password baru harus diisi!",
      minlength: "Password baru minimal 8 karakter!",
    },
    passbarulagi: {
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
</script>
@endsection