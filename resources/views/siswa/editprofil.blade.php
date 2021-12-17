@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Edit Profil')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebarsiswa')
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
                <a href="/siswa/profil/"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div id="fotoprofil" class="card-body box-profile">
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
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-9">
           <!-- general form elements -->
          <div class="card card-info" >
            <div class="card-header">
              <h3 class="card-title">
                Form
              </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" id="formedit" action="{{url('/')}}/siswa/profil/edit-akun" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-body" style="padding: 1.75rem 3rem;">
                <div class="form-group row">
                  <label for="nis" class="col-sm-2 col-form-label">NIS<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10">
                      <input disabled name="nis" class="form-control" value="{{$user->nis}}" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10">
                    <input disabled type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." value="{{$user->nama}}" maxlength="50">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10 input-group date">
                    <input type="date" class="form-control datetimepicker-input" name="tgl_lahir" value="{{$user->tgl_lahir}}"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10">
                    <select disabled class="form-control select2bs4" name="kd_kelas" style="width: 100%;">
                      <option <?php echo $user->kd_kelas == '1' ? 'selected': '' ?> value="1">XI MM 1</option>
                      <option <?php echo $user->kd_kelas == '2' ? 'selected': '' ?> value="2">XI MM 2</option>
                      <option <?php echo $user->kd_kelas == '3' ? 'selected': '' ?> value="1">XI MM 3</option>
                      <option <?php echo $user->kd_kelas == '4' ? 'selected': '' ?> value="2">XI AKL 1</option>
                      <option <?php echo $user->kd_kelas == '5' ? 'selected': '' ?> value="1">XI AKL 2</option>
                      <option <?php echo $user->kd_kelas == '6' ? 'selected': '' ?> value="2">XI OTKP 1</option>
                      <option <?php echo $user->kd_kelas == '7' ? 'selected': '' ?> value="1">XI OTKP 2</option>
                      <option <?php echo $user->kd_kelas == '8' ? 'selected': '' ?> value="2">XI BDP 1</option>
                      <option <?php echo $user->kd_kelas == '9' ? 'selected': '' ?> value="1">XI BDP 2</option>
                      <option <?php echo $user->kd_kelas == '10' ? 'selected': '' ?> value="2">XI TB</option>
                      <option <?php echo $user->kd_kelas == '11' ? 'selected': '' ?> value="1">XI PH</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." value="{{$user->telp}}" maxlength="20" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Tulis email.." value="{{Auth::user()->email}}" maxlength="50" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="alamat" class="form-control" id="telp" placeholder="Tulis alamat lengkap.."s>{{$user->alamat}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                <label for="orang_tua" class="col-sm-2 col-form-label">Nama Orang Tua/ Wali<strong class="text-danger">*</strong></label>
                <div class="col-sm-10">
                  <input type="text" name="orang_tua" class="form-control" id="orang_tua" placeholder="Tulis nama orang tua/wali.." maxlength="50" value="{{$user->orang_tua}}"/>
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
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script defer>
  $(function () {
     //Initialize Select2 Elements
     $('.select2').select2()
     //Initialize Select2 Elements
     $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $.validator.setDefaults({});
     $('#formedit').validate({
      rules: {
        email: {
          email: true,
        },
        orang_tua: {
            required: true,
        }
      },
      messages: {
         email: {
          email: "Mohon isi email dengan benar",
        },
        orang_tua: {
          required: "Nama orang tua/wali harus diisi",
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
</script>
@endsection