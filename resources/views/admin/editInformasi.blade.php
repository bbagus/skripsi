@extends('layout.master')
@section('title')
SI-PKL : Ubah Pengumuman - {{$info->judul}}
@endsection
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
@section('judul', 'Mengubah Pengumuman')
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
         <form id="forminfo" action="{{route('edit_info')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="kd_info" value="{{$info->kd_info}}" />
          <div class="card-body" style="padding: 1.75rem 2rem;">
            <div class="form-group mb-3">
              <label for="judul">Judul pengumuman<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" name="judul" placeholder="Tulis judul.." value="{{$info->judul}}">
            </div>
            <div class="form-group mb-3 col-sm-5">
              <label for="status">Status<strong class="text-danger">*</strong></label>
              <select class="form-control select2bs4" name="status" style="width: 100%;">
                <option  <?php echo $info->status == 'Diumumkan' ? 'selected': '' ?> value="Diumumkan">Diumumkan</option>
                <option <?php echo $info->status == 'Draf' ? 'selected': '' ?> value="Draf">Draf</option>
                <option <?php echo $info->status == 'Arsip' ? 'selected': '' ?> value="Arsip">Arsip</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="isi">isi pengumuman<strong class="text-danger">*</strong></label>
              <textarea id="compose-textarea" name="isi" class="form-control" style="height: 300px">{{$info->deskripsi}}</textarea>
            </div>
            <div class="form-group mb-3 row">
              <div class="col-sm-5">
                <label for="kd_label">Label</label>
                <select class="form-control select2bs4" name="kd_label" style="width: 100%;">
                  <option <?php echo $info->kd_label == '1' ? 'selected': '' ?> value="1">Pengajuan</option>
                  <option <?php echo $info->kd_label == '2' ? 'selected': '' ?> value="2">Laporan</option>
                  <option <?php echo $info->kd_label == '3' ? 'selected': '' ?> value="3">Tips</option>
                  <option <?php echo $info->kd_label == '4' ? 'selected': '' ?> value="4">Lain-lain</option>
                </select>
              </div>
              <div class="col-sm-1">
              </div>
              <div class="col-sm-5">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" name="penulis" value="{{$info->penulis}}" placeholder="Tulis nama penulis..">
              </div>
            </div>      
            <div id="foto" class="form-group mb-3 col-sm-5">
              <label for="foto">Thumbnail</label>
              @if($info->foto != 'default.jpg')
              <a class="close"  title="hapus foto (jangan lupa klik simpan). 
reload halaman untuk batal." 
              style="margin-left: 5px;float:right;" href="javascript:void(0)" onclick="hapusFoto()">x</a>
              <img class="img-fluid mb-3" style="width: 150px;float:right;" src="{{url('/')}}/data_file/{{$info->foto}}" alt="">
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
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success" >Simpan</button>&nbsp;
              <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
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
  var isi = '{!! $info->deskripsi !!}';
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
          success: function(data){
            var pesan = $('#sukses'); 
            $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
             $(window).scrollTop(0);
             isi = $('#compose-textarea').summernote('code');
              if(data.pindah != null){
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(1000).fadeOut(400,function()
                {
                  window.location.replace("{{url('/')}}/admin/kelola-informasi/"+ data.pindah);
                });
              } else {
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
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
          }
          $(window).scrollTop(0);
        }
      });
      }
    });
  });

function myFunction() {
  document.getElementById("forminfo").reset();
  $('#compose-textarea').summernote('code',isi);
}
function hapusFoto(){
  $('#foto img').remove();
  $('#foto a').remove();
  $('#foto').append('<input type="hidden" name="hapus" value="hapus" />');
}
function goBack() {
  window.history.back();
   if(history.length < 2){
    window.close();
  }
};
function fadeOut(){
   $('#sukses').hide();
}
  </script>
@endsection
