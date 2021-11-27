@extends('layout.master')
@section('title', 'SI-PKL : Tambah Pengumuman')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- summernote -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/summernote/summernote-bs4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Menambah Pengumuman')
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
        <!-- /.card -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
             <a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
           </h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form id="forminfo" method="POST" action="{{route('upload_info')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card-body" style="padding: 1.75rem 2rem;">
            <div class="form-group mb-3">
              <label for="judul">Judul pengumuman<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" name="judul" placeholder="Tulis judul..">
            </div>
            <div class="form-group mb-3">
              <label for="isi">isi pengumuman<strong class="text-danger">*</strong></label>
              <textarea id="compose-textarea" name="isi" class="form-control" style="height: 300px"></textarea>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-5">
                <label for="kd_label">Label</label>
                <select class="form-control select2bs4" name="kd_label" style="width: 100%;">
                  <option disabled="" selected="" hidden="">Pilih label</option>
                  <option value="1">Pengajuan</option>
                  <option value="2">Laporan</option>
                  <option value="3">Tips</option>
                  <option value="4">Lain-lain</option>
                </select>
              </div>
              <div class="col-sm-1">
              </div>
              <div class="col-sm-5">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" name="penulis" value="Admin" placeholder="Tulis nama penulis..">
              </div>
            </div>
            <div class="form-group mb-3 col-sm-5">
              <label for="foto">Thumbnail</label>
              <div class="custom-file">
                <input class="custom-file-input" type="file" name="foto" accept="image/png, image/jpeg" id="customFile" >
                <label class="custom-file-label" for="customFile">Pilih file</label>
                <font color="red">
                  Ukuran file maksimal 700 KB.<br>
                  Format file : jpg, jpeg, png.
                </font>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button name="submit" value="1" type="submit" class="btn btn-success" > Umumkan</button>&nbsp;
              <button name="submit" value="2" type="submit" class="btn btn-primary" >Simpan ke draft</button>&nbsp;
              <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </form>
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
<!-- Summernote -->
<script src="{{url('/')}}/AdminLTE-master/plugins/summernote/summernote-bs4.min.js"></script>
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
    //Add text editor
    $('#compose-textarea').summernote({
      minHeight: 400,
    });

    $.validator.setDefaults({});
    $('#forminfo').validate({
      rules: {
        judul: {
          required: true,
        },
        isi: {
          required: true,
        }
      },
      messages: {
        judul: {
          required: "Judul harus diisi",
        },
        isi: {
          required: "informasi harus diisi",
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
              if(data.msg == 'Berhasil menambah pengumuman!'){
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
                  $('#compose-textarea').summernote('code', '');
              } else{
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
                  $('#compose-textarea').summernote('code', '');
              }
              $(window).scrollTop(0);
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
               $(window).scrollTop(0);
           }
          });
        }
    });
  });
  function myFunction() {
    document.getElementById("forminfo").reset();
    $('#compose-textarea').summernote('code', '');
  }
function fadeOut(){
  $('#sukses').hide();
}
 function goBack() {
    window.history.back();
     if(history.length < 2){
    window.close();
  }
  };
</script>
@endsection
