@extends('layout.master')
@section('title', 'SI-PKL : Admin - Edit Profil')
@section('head')
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
  @section('judul', 'Edit Profil')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
           <!-- alert error-->
          <div id="sukses" class="alert alert-dismissible shadow" style="display:none;">
          <button type="button" class="close" onclick="fadeOut()">×</button>
          <div id="pesan">
          </div>
        </div>
        </div>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
             <div class="card-header">
              <h3 class="card-title">
                <a href="{{url('/')}}/admin/profil"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div id="fotoprofil" class="card-body box-profile">
             @if ($user->foto != 'default.jpg')
              <div class="text-center">
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$user->foto}}"
                alt="User profile picture" style="min-height:150px;">
              </div>
              <ul id="hapus" class="list-group list-group-unbordered mb-3" style="text-align: center;">
                <li class="list-group-item"> 
                  <a href="javascript:void(0)" onclick="hapusFoto('/admin/profil/hapus-foto')" class="btn btn-dark"><i class="fa fa-trash-alt"></i> Hapus Foto</a>
                </li>
              </ul>
              @else
              <div class="text-center">
                <img class="img-fluid"
                src="{{url('/')}}/data_file/guru-default.jpeg"
                alt="User profile picture" style="min-height:150px;">
              </div>
              <ul class="list-group list-group-unbordered mb-3" style="text-align: center;">
                <li class="list-group-item"> 
                </li>
              </ul>
              @endif
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
            <form class="form-horizontal" id="formedit" action="{{url('/')}}/admin/profil/edit-akun" method="POST" enctype="multipart/form-data">
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
                    <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
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
<!-- jquery form -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-form/jquery.form.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script defer>
$(function (){
  bsCustomFileInput.init();
  $.validator.setDefaults({});
   $('#formedit').validate({
    rules: {
        username: {
          required: true,
        },
        nama: {
          required: true,
        },
        nip: {
          number: true,
        },
        telp: {
          maxlength: 20,
        },
        email: {
          email: true,
        }
      },
    messages: {
        username: {
          required: "Username harus diisi",
        },
        nama: {
           required: "Nama harus diisi",
        },
        nip: {
          number: "Mohon isi NIP dengan angka",
        },
        telp: {
          maxlength: "nomor telp maksimal 20 karakter",
        },
        email: {
          email: "Mohon isi email dengan benar",
        }
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
        },
        submitHandler: function(form) {
          $(form).ajaxSubmit({
            success: function(data){
              var pesan = $('#sukses'); 
              $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
              if(data.msg == 'Berhasil mengubah detail profil!'){
                if(data.pindah != null){
                  pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(1000).fadeOut(400,function()
                  {
                    window.location.reload();
                  });
                } else {
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
                }
              } else {
                pesan.removeClass('alert-success').addClass('alert-danger').fadeIn().delay(3000).fadeOut('slow');
              }
            },
            error: function (xhr) {
               if (xhr.status == 422) {
                var pesan = $('#pesan');
                pesan.html('<i class="icon fas fa-exclamation-triangle"></i>');
                  $.each(xhr.responseJSON.errors, function (i, error) {
                pesan.append(error);
                });
                  $('#sukses').removeClass('alert-success').addClass('alert-danger').fadeIn().delay(3000).fadeOut('slow');
               } else {
                var pesan = $('#pesan');
                pesan.html('<i class="icon fas fa-exclamation-triangle"></i>'+ 'Terdapat kendala di server');
                 $('#sukses').removeClass('alert-success').addClass('alert-danger').fadeIn().delay(3000).fadeOut('slow');
              }
           }
          });
        }
  }); 
});
function myFunction() {
    document.getElementById("formedit").reset();
 }
function fadeOut(){
    $('#sukses').hide();
 }
function hapusFoto(url){
  $.ajax({
    method: "GET",
    url: url
  }).done(function(data){
    $('#fotoprofil div').remove();
     $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
      $('#sukses').removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut(400,
        function(){
          window.location.reload();
        });
  });
}
</script>
@endsection