@extends('layout.master')
@section('title', 'SI-PKL : Guru - Laporan PKL')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebarguru')
@endsection
@section('judul', 'Bimbingan Laporan PKL')
@section('content')
    <!-- Main content -->
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
            <div class="card card-info">
              <div class="card-header">
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
                <h3 class="card-title">
                Daftar Siswa
                </h3>
              </div>
              <div class="card-body p-2" id="siswa">
               <ul class="nav nav-pills flex-column">
                @foreach($penempatan as $s)
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link {{$s->kd_penempatan}}" > {{$s->nama}}</a>
                </li>
                @endforeach
              </ul>
            </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header" style="background-color: #094688;">
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
               <h3 class="card-title text-white">
                Riwayat Bimbingan
              </h3>
            </div>
            <div class="card-body">
              <form id="bimbingan" action="{{url('/')}}/guru/laporan-pkl/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- The time line -->
                 <div id="klik">Klik nama siswa</div>
                <div id="timeline" class="timeline">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.timeline -->
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- jquery form -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-form/jquery.form.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<script defer>
  $(function(){
    $.validator.setDefaults({});
    $('#bimbingan').validate({
       rules: {
        judul:  {
          required: true,
        },
        catatan: {
          required: true,
        }
      },
      messages: {
        judul: {
          required: "Judul harus diisi!"
        },
        catatan: {
          required: "Catatan harus diisi!"
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
            if(data.msg == 'Berhasil menambah bimbingan!'){
                pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
                $('#tambah').remove();
                var htmlfile = '';
                if(data.bimbingan.file!=null){
                  htmlfile = '<div class="timeline-footer px-3"><a href="{{url('/')}}/data_file/'+data.bimbingan.file+'" class="text-dark"><i class="far fa-file-word fa-2x text-primary"></i> '+data.bimbingan.file+'</a>';
                }
                var timeline =  $('.timeline');
                timeline.append('<div><i class="fas fa-user bg-lightblue"></i><div class="timeline-item"><span class="time text-white"><i class="fas fa-clock"></i> '+data.bimbingan.jam+' </span><h3 class="timeline-header bg-lightblue"><a href="javascript:void(0)">'+data.bimbingan.pengirim+'</a></h3><p class="timeline-header px-3">'+data.bimbingan.judul+'</p><div class="timeline-body px-3">'+data.bimbingan.catatan+'</div>'+htmlfile+'</div></div>');
                timeline.append('<div id="tambah" class="time-label pt-3"><button onclick="tambahBimbingan('+data.bimbingan.kd_penempatan+')" class="btn btn-small btn-success" style="position:absolute;"><i class="fas fa-plus"></i> tambah bimbingan</button></div>');
            } else{
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
        })
      }
    });
  var siswa = $('#siswa ul');
    var source;
    siswa.on('click', 'a', function() {
      $('#klik').html('');
      var header = document.getElementById('siswa');
      var x = header.getElementsByClassName('nav-link');
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('text-primary');
        x[i].classList.remove('mark');
      }
      this.classList.remove('nav-link'); 
      //sumthing
      var kd = this.className;
      source = '{{url('/')}}/guru/laporan-pkl/'+kd;
      this.classList.add('text-primary');
      this.classList.add('mark');
      this.classList.add('nav-link');
      $.ajax({
        method: "GET",
        url: source,
        dataType: 'json',
        delay: 250,
      }).done(function(data){
        var timeline = $('#timeline');
        timeline.html('');
        timeline.append('<input type="hidden" value="'+kd+'" name="kd_penempatan">');
        var datatgl = data.tgl;
      for (const tgl in datatgl) {
          timeline.append(' <div class="time-label"><span class="bg-danger">'+datatgl[tgl]+'</span></div>');
          data.bimbingan.forEach(function(bimbingan){
            if(datatgl[tgl]==bimbingan.tgl){
              var htmlfile = '';
                if(bimbingan.file!=null){
                  htmlfile = '<div class="timeline-footer px-3"><a href="{{url('/')}}/data_file/'+bimbingan.file+'" class="text-dark"><i class="far fa-file-word fa-2x text-primary"></i> '+bimbingan.file+'</a>';
                }
              var bg = 'bg-lightblue';
              if(bimbingan.pengirim!='{{$user->nama}}') bg = 'bg-primary';
              timeline.append('<div><i class="fas fa-user '+bg+'"></i><div class="timeline-item"><span class="time text-white"><i class="fas fa-clock"></i> '+bimbingan.jam+' </span><h3 class="timeline-header '+bg+'"><a href="javascript:void(0)">'+bimbingan.pengirim+'</a></h3><p class="timeline-header px-3" >'+bimbingan.judul+'</p><div class="timeline-body px-3">'+bimbingan.catatan+'</div>'+htmlfile+'</div></div>');
            }
          });
        }
        //endforeach 2x
        timeline.append('<div id="tambah" class="time-label pt-3"><button onclick="tambahBimbingan('+kd+')" class="btn btn-small btn-success" style="position:absolute;"><i class="fas fa-plus"></i> tambah bimbingan</button></div>');
      });
    });
  });
function tambahBimbingan(kd_penempatan){
var tambah = $('#tambah');
tambah.removeClass('pt-3')
tambah.html('<i class="fas fa-user bg-lightblue"></i><div class="timeline-item"><h3 class="timeline-header bg-lightblue"><a href="javascript:void(0)">{{$user->nama}}</a></h3><div ><input type="text" class="form-control border-left-0 border-right-0 border-top-0" name="judul" placeholder="tulis judul"></div><div ><textarea class="form-control border-left-0 border-right-0 border-top-0" name="catatan" placeholder="tulis deskripsi" style="height:100px;" ></textarea></div><div class="timeline-footer mx-2"><div class="custom-file"><input name="file" id="files" type="file" style="" accept="application/msword,application/pdf"/></div><input class="btn btn-small btn-success" type="submit"  form="bimbingan" value="Kirim"></div></div>');
};
</script>
@endsection