@extends('layout.master')
@section('title')
SI-PKL : Ubah Data Industri - {{$industri->nama}}
@endsection
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebaradmin')
@endsection
@section('judul', 'Mengubah Data Industri') 
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
        <div class="card card-info" >
          <div class="card-header">
            <h3 class="card-title">
              <a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" id="formindustri" action="{{route('edit_industri')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="kd_industri" value="{{$industri->kd_industri}}" />
            <div class="card-body" style="padding: 1.75rem 5rem;">
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama<strong class="text-danger">*</strong></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama industri.." maxlength="50" value="{{$industri->nama}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="bidang_kerja" class="col-sm-2 col-form-label">Bidang kerja<strong class="text-danger">*</strong></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="bidang_kerja" placeholder="Tulis bidang kerja.." maxlength="50" value="{{$industri->bidang_kerja}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                  <textarea type="text" name="deskripsi" class="form-control" placeholder="Tulis deskripsi.."s>{{$industri->deskripsi}}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat<strong class="text-danger">*</strong></label>
                <div class="col-sm-9">
                  <textarea type="text" name="alamat" class="form-control" placeholder="Tulis alamat lengkap.."s>{{$industri->alamat}}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="wilayah" class="col-sm-2 col-form-label">Wilayah<strong class="text-danger">*</strong></label>
                <div class="col-sm-3">
                  <input type="text" name="wilayah" class="form-control" placeholder="Tulis wilayah/kota.." maxlength="50" value="{{$industri->wilayah}}">
                </div>
                <div class="col-sm-1"></div>
                <label for="website" class="col-sm-1 col-form-label">Website</label>
                <div class="col-sm-4">
                  <input type="text" name="website" class="form-control"  placeholder="Tulis alamat website.." maxlength="50" value="{{$industri->website}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                <div class="col-sm-3">
                  <input type="text" name="telp" class="form-control" placeholder="Tulis nomor telepon.." maxlength="20" value="{{$industri->telp}}">
                </div>
                <div class="col-sm-1"></div>
                <label for="nama_kontak" class="col-sm-1 col-form-label">Nama kontak</label>
                <div class="col-sm-4">
                  <input type="text" name="nama_kontak" class="form-control"  placeholder="Tulis nama kontak.." maxlength="50" value="{{$industri->nama_kontak}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                  <input type="email" name="email" class="form-control"  placeholder="Tulis alamat email.." maxlength="50" value="{{$industri->email}}">
                </div>
                <div class="col-sm-1"></div>
                <label for="kuota" class="col-sm-1 col-form-label">Kuota</label>
                <div class="col-sm-4">
                  <input type="text" name="kuota" class="form-control"  placeholder="Tulis kuota.." maxlength="50" value="{{$industri->kuota}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Logo industri</label>
                <div id="foto" class="col-sm-9">
                  @if($industri->foto != 'default.jpg')
                  <img class="img-fluid mb-3" style="width: 150px;float:left;" src="{{url('/')}}/data_file/{{$industri->foto}}" alt="">
                  <a class="close" title="hapus foto (jangan lupa klik simpan). 
reload halaman untuk batal." style="float: left;
                  margin-left: 5px;" href="javascript:void(0)" onclick="hapusFoto('{{url('/')}}/admin/kelola-industri/hapus-foto/{{$industri->kd_industri}}')">x</a>
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
        $('#formindustri').validate({
         rules: {
          nama: {
            required: true,
          },
          bidang_kerja: {
            required: true,
          },
          alamat: {
            required: true,
          },
          wilayah: {
            required: true,
          },
          email: {
            email: true,
          }
        },
        messages: {
          nama: {
            required: "Nama harus diisi",
          },
          bidang_kerja: {
            required: "Bidang kerja harus diisi",
          },
          alamat: {
            required: "Alamat harus diisi",
          },
          wilayah: {
            required: "Wilayah harus diisi",
          },
          email : {
            email: "Isi email dengan benar",
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
              if(data.msg == 'Berhasil mengubah data industri!'){
                if(data.pindah != null){
                  pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(1000).fadeOut(400,function()
                  {
                    window.location.replace("{{url('/')}}/admin/kelola-industri/"+ data.pindah);
                  });
                } else {
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
                }
              } else {
                pesan.removeClass('alert-success').addClass('alert-danger').fadeIn().delay(3000).fadeOut('slow');
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
function hapusFoto(){
      $('#foto img').remove();
      $('#foto a').remove();
      $('#foto').append('<input type="hidden" name="hapus" value="hapus" />');
}
  function fadeOut(){
    $('#sukses').hide();
  }
  function myFunction() {
    document.getElementById("formindustri").reset();
  }
function goBack() {
    window.history.back();
     if(history.length < 2){
    window.close();
  }
  };
</script>
@endsection
