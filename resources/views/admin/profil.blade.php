@extends('layout.master')
@section('title', 'SI-PKL : Admin - Profil')
@section('head')
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Profil Admin')
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
                src="{{url('/')}}/data_file/guru-default.jpeg"
                alt="User profile picture" style="min-height:150px;">
                @endif
              </div>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"> 
                  <a href="/admin/profil/edit" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Perbarui Detail Akun</a>
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
                <li class="nav-item"><a class="nav-link <?php echo count($errors) > 0 ? '': 'active' ?>" href="#activity" data-toggle="tab">Profil</a></li>
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
                          <td>NIP</td>
                          <td>:</td>
                          <td>{{$user->nip}}</td>
                        </tr>
                        <tr>
                          <td>No. Telp</td>
                          <td>:</td>
                          <td>{{$user->telp}}</td>
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
                        <td>{{Auth::user()->username}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td colspan="2">{{Auth::user()->email}}</td>
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
</script>
@endsection