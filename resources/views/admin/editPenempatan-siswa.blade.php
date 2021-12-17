@extends('layout.master')
@section('title', 'SI-PKL : Admin - Edit Penempatan')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
 @include('layout.sidebaradmin')
@endsection
@section('judul', 'Edit Penempatan')
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
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-info">
            <div class="card-header">
             <h3 class="card-title">
                <a href="javascript:void(0)" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div><!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" id="formedit" action="{{url('/')}}/admin/kelola-penempatan/edit" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-body" style="padding: 1.75rem 3rem;">
                 <input type="hidden" class="form-control" id="kd" name="kd_penempatan"value="{{$penempatan->kd_penempatan}}">
                 <input type="hidden" class="form-control"  name="kd_pengajuan"value="{{$penempatan->kd_pengajuan}}">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">NIS<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis NIS.." maxlength="15" value="{{$penempatan->nis}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." maxlength="50" value="{{$penempatan->nama}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10">
                    <select class="form-control select2bs4" name="kd_kelas" style="width: 100%;" disabled>
                       <option selected="" value="{{$penempatan->kelas}}">{{$penempatan->kelas}}</option>
                        <option value="XI MM 1">XI MM 1</option>
                        <option value="XI MM 2">XI MM 2</option>
                        <option value="XI MM 3">XI MM 3</option>
                        <option value="XI AKL 1">XI AKL 1</option>
                        <option value="XI AKL 2">XI AKL 2</option>
                        <option value="XI OTKP 1">XI OTKP 1</option>
                        <option value="XI OTKP 2">XI OTKP 2</option>
                        <option value="XI BDP 1">XI BDP 1</option>
                        <option value="XI BDP 2">XI BDP 2</option>
                        <option value="XI TB">XI TB</option>
                        <option value="XI PH">XI PH</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="guru" class="col-sm-2 col-form-label">Guru Pembimbing</label>
                    <div class="col-sm-10">
                       <select class="form-control searchguru" name="guru" style="width: 100%;">
                        <option value="{{$penempatan->kd_pembimbing}}">{{$penempatan->guru}}</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="livesearch" class="col-sm-2 col-form-label">Instansi</label>
                  <div class="col-sm-10">
                    <select class="form-control livesearch" name="industri" style="width: 100%;">
                      <option value="{{$penempatan->kd_industri}}">{{$penempatan->industri}}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-10 input-group date">
                      <input type="date" class="form-control datetimepicker-input" name="tgl_mulai" value="{{$penempatan->tgl_mulai}}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-10 input-group date">
                      <input type="date" class="form-control" name="tgl_selesai" value="{{$penempatan->tgl_selesai}}">
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="padding: .75rem 3rem;">
                  <input type="submit" class="btn btn-success" value="Simpan">
                </div>
              <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-3">
        <div class="card card-orange">
              <div class="card-header ">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus text-white"></i>
                  </button>
                </div>
                <h3 class="card-title text-white">
                  Lampiran
                </h3>
              </div>
              <div class="card-body" style="padding: 1.75rem 1.75rem;">
                <p class="text-justify">
              </p>
              </div>
            </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('javascript')
<!-- jquery form -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-form/jquery.form.min.js"></script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<script defer>
$(document).ready(function () {
   $(".searchguru").on('select2:open', () => { document.querySelector('.select2-search__field').focus();
 });
   $(".livesearch").on('select2:open', () => { document.querySelector('.select2-search__field').focus();
 });
});
$('.livesearch').select2({
    placeholder: 'Pilih Instansi',
    allowClear: true,
    ajax: {
      url: '/admin/kelola-penempatan-cariindustri',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nama,
              id: item.kd_industri
            }
          })
        };
      },
      cache: true
    }
  });
$('.searchguru').select2({
    placeholder: 'Pilih Guru pembimbing',
    allowClear: true,
    ajax: {
      url: '/admin/kelola-penempatan-cariguru',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nama,
              id: item.kd_pembimbing
            }
          })
        };
      },
      cache: true
    }
 });
$(function () {
 $.validator.setDefaults({});
 $('#formedit').validate({
  rules: {
    tgl_mulai: {
      required: true,
      date: true,
    },
    tgl_selesai: {
      required: true,
      date: true,
    },
  },
  messages: {
    tgl_mulai: {
      required: "Mohon isi tanggal dengan benar!",
      date: "Mohon isi tanggal dengan benar!",
    },
    tgl_selesai: {
      required: "Mohon isi tanggal dengan benar!",
      date: "Mohon isi tanggal dengan benar!",
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
  },
  submitHandler: function(form) {
    $(form).ajaxSubmit({
      success: function(data){
        var pesan = $('#sukses'); 
        $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
        if(data.msg == 'Berhasil mengubah penempatan!'){
          pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');     
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