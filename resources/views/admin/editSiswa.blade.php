@extends('layout.master')
@section('title')
SI-PKL : Ubah Data Siswa - {{$siswa->nama}}
@endsection
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Mengubah Data Siswa')
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
        <form class="form-horizontal" id="formsiswa" action="{{route('proses_edit')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="nislama" value="{{$siswa->nis}}" />
          <div class="card-body" style="padding: 1.75rem 3rem;">
            <div class="form-group row">
              <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Siswa<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis nomor induk siswa.." value="{{$siswa->nis}}" maxlength="15">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." value="{{$siswa->nama}}" maxlength="50">
              </div>
            </div>
            <div class="form-group row">
              <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
              <div class="col-sm-10 input-group date">
                <input type="date" class="form-control datetimepicker-input" name="tgl_lahir" value="{{$siswa->tgl_lahir}}"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <select class="form-control select2bs4" name="kd_kelas" style="width: 100%;">
                  <option selected="" value="{{$siswa->kd_kelas}}">{{$siswa->kelas}}</option>
                  @foreach ($kelas as $kelas)
                  <option value="{{$kelas->kd_kelas}}">{{$kelas->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
              <div class="col-sm-10">
                <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." value="{{$siswa->telp}}" maxlength="20" >
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea type="text" name="alamat" class="form-control" id="telp" placeholder="Tulis alamat lengkap.."s>{{$siswa->alamat}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="orang_tua" class="col-sm-2 col-form-label">Nama Orang Tua/ Wali<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" name="orang_tua" class="form-control" id="orang_tua" placeholder="Tulis nama orang tua/wali.." maxlength="50" value="{{$siswa->orang_tua}}"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
              <div id="foto" class="col-sm-10">
                @if($siswa->foto != 'default.jpg')
                <img class="img-fluid mb-3" style="width: 150px;float:left;" src="{{url('/')}}/data_file/{{$siswa->foto}}" alt="">
                <a class="close" title="hapus foto (jangan lupa klik simpan). 
reload halaman untuk batal." style="float: left;
                margin-left: 5px;" href="javascript:void(0)" onclick="hapusFoto()">x</a>
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
    <div class="col-md-3">
      <div class="card card-orange">
        <div class="card-header ">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus text-white"></i>
            </button>
          </div>
          <h3 class="card-title text-white">
            Akun
          </h3>
        </div>
        <div class="card-body" style="padding: 1rem 2rem;">
          <p class="text-justify">
            <div class="row">
              <div class="col-4">Username</div>
              <div class="col-1">:</div>
              <div class="col-6">{{$siswa->username}} (NIS)</div>
              <div class="col-4">Email</div>
              <div class="col-1">:</div>
              <div class="col-6">{{$siswa->email}}
              </div>
              <div class="col-4">Password</div>
              <div class="col-1">:</div>
              <div class="col-6">
                <a onclick="resetConfirm()" href="javascript:void(0)">Reset password</a></div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('modal')
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Password akan kembali ke setelan awal (Tanggal lahir siswa).</div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="javascript:void(0)" onclick="resetPassword('{{url('/')}}/admin/kelola-siswa/reset-password/{{$siswa->nis}}')">Reset</a>
      </div>
    </div>
  </div>
</div>
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
         orang_tua: {
            required: true,
          }
      },
      messages: {
        nis: {
          required: "NIS harus diisi",
          number: "Mohon isi NIS dengan benar"
        },
        nama: {
          required: "Nama lengkap harus diisi",
        },

        tgl_lahir: {
          required: "Tanggal lahir harus diisi",
          date: "Mohon isi tanggal dengan benar"
        },
        kd_kelas: {
          required: "Kelas harus diisi",
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
              if(data.msg == 'Berhasil mengubah data siswa!'){
                if(data.pindah != null){
                  pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(1000).fadeOut(400,function()
                  {
                    window.location.replace("{{url('/')}}/admin/kelola-siswa/"+ data.pindah);
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
  function resetPassword(url){
    $.ajax({
      method: "GET",
      url: url
    }).done(function(data){
      $('#resetModal').modal('hide');
      $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
      $('#sukses').removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
    }).fail(function(data){
      $('#resetModal').modal('hide');
      $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+"Password gagal direset.");
      $('#sukses').removeClass('alert-success').addClass('alert-danger').fadeIn().delay(3000).fadeOut('slow');
    });
  }
  function hapusFoto(){
      $('#foto img').remove();
      $('#foto a').remove();
      $('#foto').append('<input type="hidden" name="hapus" value="hapus" />');
  }
  function fadeOut(){
    $('#sukses').hide();
  }
  function myFunction() {
    document.getElementById("formsiswa").reset();
  }
  function resetConfirm(){
    $('#resetModal').modal();
  }
  function goBack() {
    window.history.back();
     if(history.length < 2){
    window.close();
  }
  };
</script>
@endsection
