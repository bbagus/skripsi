@extends('layout.master')
@section('title', 'SI-PKL : Tambah Data Siswa')
@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Menambah Data Siswa')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- alert error-->
       <div id="sukses" class="alert alert-dismissible shadow" style="display:none;">
        <button type="button" class="close" onclick="fadeOut()">×</button>
        <div id="pesan">
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <!-- general form elements -->
      <div class="card card-info" >
        <div class="card-header">
          <h3 class="card-title">
            <a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" id="formsiswa" action="{{route('proses_upload')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card-body" style="padding: 1.75rem 3rem;">
            <div class="form-group row">
              <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Siswa<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis nomor induk siswa.." maxlength="15">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." maxlength="50">
              </div>
            </div>
            <div class="form-group row">
              <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
              <div class="col-sm-10 input-group date">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
              </div>
            </div>
            <div class="form-group row">
              <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <select class="form-control select2bs4" name="kd_kelas" id="kd_kelas" style="width: 100%;">
                  <option disabled="" selected="" hidden="">Pilih kelas</option>
                  @foreach ($kelas as $kelas)
                  <option value="{{$kelas->kd_kelas}}">{{$kelas->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
              <div class="col-sm-10">
                <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." maxlength="20">
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Tulis alamat lengkap.." maxlength="255"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="orang_tua" class="col-sm-2 col-form-label">Nama Orang Tua/ Wali<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" name="orang_tua" class="form-control" id="orang_tua" placeholder="Tulis nama orang tua/wali.." maxlength="50"/>
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
    <div class="col-md-3">
      <div class="card card-orange">
        <div class="card-header ">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus text-white"></i>
            </button>
          </div>
          <h3 class="card-title text-white">
            Keterangan
          </h3>
        </div>
        <div class="card-body" style="padding: 1.75rem 1.75rem;">
          <p class="text-justify">
            Dengan menambahkan data siswa baru, maka akun untuk siswa otomatis akan dibuat dengan informasi akses :<br>
            <div class="row">
              <div class="col-4">Username</div>
              <div class="col-1">:</div>
              <div class="col-6">Nomor Induk Siswa</div>
              <div class="col-4">Password</div>
              <div class="col-1">:</div>
              <div class="col-6">Tanggal lahir. Format "hhbbtttt"</div>
            </div>
          </p>
        </div>
      </div>
      <div class="card card-primary">
        <div class="card-header ">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus text-white"></i>
            </button>
          </div>
          <h3 class="card-title text-white">
            Import Data
          </h3>
        </div>
        <div class="card-body" style="padding: 1.75rem 1.75rem;">
          <p class="text-justify">
            Dapat menambahkan data siswa secara sekaligus menggunakan file berekstensi *.xls atau*.xlsx. File yang diunggah harus sesuai format file excel berikut :<br></p>
            <div class="form-group">
             <a class="btn btn-block btn-outline-primary" href="#"><i class="fas fa-download"></i> TEMPLATE FILE EXCEL</a>
           </div>
           <div class="form-group">
            <label for="customFile">Unggah file excel</label>
            <div class="custom-file">
              <input class="custom-file-input" type="file" name="foto" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="customFile" >
              <label class="custom-file-label" for="customFile">Pilih file</label>
            </div>
          </div>
          <div class="form-group" style="text-align:center;">
            <input type="submit" class="btn btn-success" value="Unggah">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('javascript')
<!-- jquery form -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-form/jquery.form.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script defer>
  $(function () {
    bsCustomFileInput.init();
      //Initialize Select2 Elements
      $('.select2').select2()
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $.validator.setDefaults({});
      $('#formsiswa').validate({
        rules: {
          nis: {
            required: true,
            number: true,
          },
          nama: {
            required: true,
          },
          tgl_lahir: {
            required: true,
            date: true,
          },
          kd_kelas: {
            required: true,
          },
          telp: {
            maxlength: 20,
          },
          orang_tua: {
            required: true,
          }
        },
        messages: {
          nis: {
            required: "NIS harus diisi",
            number: "Mohon isi NIS dengan benar",
          },
          nama: {
            required: "Nama lengkap harus diisi",
          },
          tgl_lahir: {
            required: "Tanggal lahir harus diisi",
            date: "Mohon isi tanggal dengan benar",
          },
          kd_kelas: {
            required: "Kelas harus diisi",
          },
          telp: {
            maxlength: "Nomor telepon terlalu panjang!",
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
            clearForm: true,
            success: function(data){
              var pesan = $('#sukses'); 
              $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
              if(data.msg == 'Berhasil input data siswa!'){
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
              } else{
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
function fadeOut(){
  $('#sukses').hide();
}
  function myFunction() {
    document.getElementById("formsiswa").reset();
  }
  function goBack() {
    window.history.back();
     if(history.length < 2){
    window.close();
  }
  };
</script>

@endsection
