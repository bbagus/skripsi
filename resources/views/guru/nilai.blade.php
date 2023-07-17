@extends('layout.master')
@section('title', 'SI-PKL : Guru - Kelola Nilai')
@section('sidebar')
  @include('layout.sidebarguru')
@endsection
@section('judul', 'Kelola Nilai')
@section('content')
<!-- Main content -->
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
                @foreach($siswa as $s)
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
                Form Nilai
                </h3>
              </div>
              <div class="card-body">
                <form id="formnilai" action="{{url('/')}}/guru/kelola-nilai/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="kd_penempatan" name="kd_penempatan" value="">
                 <input type="hidden" id="kd_nilai" name="kd_nilai" value="">
                <!-- The time line -->
                 <div id="klik" class="mx-3">Klik nama siswa</div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- col -->
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
<script defer>
$(function(){
  $.validator.setDefaults({});
  $('#formnilai').validate({
     rules: {
      nilai_sikap:  {
      maxlength: 3,
      },
      nilai_pengetahuan: {
        maxlength: 3
      },
       nilai_keterampilan: {
        maxlength: 3
      }
    },
    messages: {
      nilai_sikap:  {
        max: "Mohon isi tidak lebih dari 3 karakter!"
      },
      nilai_pengetahuan: {
        max: "Mohon isi tidak lebih dari 3 karakter!"
      },
       nilai_keterampilan: {
        max: "Mohon isi tidak lebih dari 3 karakter!"
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
          if(data.msg == 'Berhasil input nilai!'){
            pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');

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
    var isi = $('#klik');
    var header = document.getElementById('siswa');
    var x = header.getElementsByClassName('nav-link');
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('text-primary');
        x[i].classList.remove('mark');
      }
      this.classList.remove('nav-link');
      var kd = this.className;
      source = '{{url('/')}}/guru/kelola-nilai/'+kd; 
      this.classList.add('text-primary');
      this.classList.add('mark');
      this.classList.add('nav-link');
      $.ajax({
        method: "GET",
        url: source,
        dataType: 'json',
        delay: 250,
      }).done(function(data){
        $('#kd_penempatan').val(kd);
        isi.html('');
        var sikap = data.nilai_sikap!=undefined?data.nilai_sikap:'';
        var pengetahuan = data.nilai_pengetahuan!=undefined?data.nilai_pengetahuan:'';
        var keterampilan = data.nilai_keterampilan!=undefined?data.nilai_keterampilan:'';
         isi.append('<div class="form-group row"><label for="nilai_sikap" class="col-sm-2 col-form-label">Nilai Sikap</label><div class="col-sm-10"><input type="text" class="form-control"  name="nilai_sikap" id="nilai_sikap" placeholder="Isi nilai sikap.." maxlength="3" value="'+sikap+'"></div></div>');
         isi.append('<div class="form-group row"><label for="nilai_pengetahuan" class="col-sm-2 col-form-label">Nilai Pengetahuan</label><div class="col-sm-10"><input type="text" class="form-control"  name="nilai_pengetahuan" id="nilai_pengetahuan" placeholder="Isi nilai pengetahuan.." maxlength="3" value="'+pengetahuan+'"></div></div>');
         isi.append('<div class="form-group row"><label for="nilai_keterampilan" class="col-sm-2 col-form-label">Nilai Keterampilan</label><div class="col-sm-10"><input type="text" class="form-control"  name="nilai_keterampilan" id="nilai_keterampilan" placeholder="Isi nilai keterampilan.." maxlength="3" value="'+keterampilan+'"></div></div>');
         isi.append('<div class="form-group row mx-2 mt-3"><input class="btn btn-small btn-success" type="submit" form="formnilai" value="Simpan"></div>');
      });
     
    });
});
</script>
@endsection