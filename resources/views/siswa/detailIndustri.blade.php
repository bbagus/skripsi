@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Detail Instansi PKL')
@section('head')
@endsection
@section('sidebar')
  @include('layout.sidebarsiswa')
@endsection
@section('judul', 'Detail & Jadwal PKL')
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
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
             <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            <h3 class="card-title">
              Guru Pembimbing
            </h3>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>No. Telp</th>
                  <th>Foto</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @if($penempatan!=null)
                  <td>{{$penempatan->nama}}</td>
                  <td>{{$penempatan->nip}}</td>
                  <td>{{$penempatan->telp}}</td>
                  <td style="max-width: 80px;">
                    @if($penempatan->foto!='default.jpg')
                    <img class="img-fluid" src="{{url('/')}}/data_file/{{$penempatan->foto}}" alt="foto guru">
                    @else
                    <img class="img-fluid" src="{{url('/')}}/data_file/guru-default.jpeg" alt="foto guru">
                    @endif
                  </td>
                  @else
                  <td colspan="4">
                    <div class="alert alert-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                 Belum mendapat Guru Pembimbing
                  </div>
                  </td>
                  @endif
                </tr>
                  </tbody>
                </table>
              </div>
            </div>
           <!-- general form elements -->
          <div class="card card-primary" >
            <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
               <h3 class="card-title">
                Detail Instansi
              </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(is_null($industri))
            <div class="card-body">
              <div class="alert alert-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
              Pengajuan Anda belum diterima
              </div>
            </div>
            @else
            <div class="card-body" style="padding: 1.75rem 3rem;">
              <form class="form-horizontal" id="formedit" action="{{url('/')}}/siswa/detail-instansi/edit" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input id="kd_detail" type="hidden" name="kd_detail" value="{{$detail!=null?$detail->kd_detail:''}}"/>
                <input type="hidden" name="kd_pengajuan" value="{{$industri->kd_pengajuan}}"/>
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Instansi<strong class="text-danger">*</strong></label>
                  <div class="col-sm-10">
                    <a class="form-control" href="{{url('/')}}/industri/{{$industri->kd_industri}}">{{$industri->nama}}</a>
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input disabled   type="text" class="form-control" name="alamat" placeholder="Tulis nama industri.." value="{{$industri->alamat}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bagian" class="col-sm-2 col-form-label">Bagian/Divisi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="bagian" placeholder="Tulis bagian/divisi.." maxlength="50" value="{{ $detail == null ? '': $detail->bagian }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pimpinan" class="col-sm-2 col-form-label">Nama Pimpinan Instansi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="pimpinan" placeholder="Tulis nama pimpinan instansi.." maxlength="50" value="{{ $detail == null ? '': $detail->pimpinan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pembimbing" class="col-sm-2 col-form-label">Nama Pembimbing Instansi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="pembimbing" placeholder="Tulis nama pembimbing instansi.." maxlength="50" value="{{ $detail == null ? '': $detail->pembimbing }}">
                  </div>
                </div>
              </form>
            </div> 
              <!-- /.card-body -->
              <div class="card-footer" style="padding: .75rem 3rem;">
                <input type="submit" form="formedit" class="btn btn-success" value="Simpan">
                &nbsp;
                <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
              </div>
              <!-- /.card-footer -->
              @endif
        </div>
        <div class="card card-info">
            <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
               <h3 class="card-title">
                Jadwal PKL
              </h3>
            </div>
            <div class="card-body" style="padding: 1.75rem 3rem;">
              <table class="table table-bordered table-striped">
                <form action="{{url('/')}}/siswa/detail-instansi/jadwal" id="formjadwal" method="POST" >
                  {{ csrf_field() }}
                  <input type="hidden" id="kd_detail2" name="kd_detail" value="{{$detail!=null?$detail->kd_detail:''}}"/>
                  <input type="hidden" id="kd_jadwal" name="kd_jadwal" value="{{$jadwal!=null?$jadwal->kd_jadwal:''}}">
                  <thead>
                    <tr>
                      <th>Hari</th>
                      <th>Jam Masuk Pagi</th>
                      <th>Jam Masuk Siang</th>
                      <th>Jam Istirahat</th>
                      <th>Jam Pulang Sore</th>
                      <th>Jam Pulang Malam</th>
                    </tr>
                  </thead>
                  <tbody id="bodyjadwal">
                    <tr>
                      <td>Senin</td>
                      @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="senin[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->senin[$i]:''}}"/></td>
                      @endfor
                      </tr>
                     <tr>
                      <td>Selasa</td>
                      @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="selasa[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->selasa[$i]:''}}"/></td>
                      @endfor
                    </tr>
                     <tr>
                      <td>Rabu</td>
                     @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="rabu[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->rabu[$i]:''}}"/></td>
                      @endfor
                    </tr>
                     <tr>
                      <td>Kamis</td>
                      @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="kamis[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->kamis[$i]:''}}"/></td>
                      @endfor
                    </tr>
                     <tr>
                      <td>Jumat</td>
                      @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="jumat[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->jumat[$i]:''}}"/></td>
                      @endfor
                    </tr>
                     <tr>
                      <td>Sabtu</td>
                       @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="sabtu[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->sabtu[$i]:''}}"/></td>
                      @endfor
                    </tr>
                     <tr>
                      <td>Minggu</td>
                      @for($i = 0; $i < 5; $i++)
                      <td><input disabled type="time" class="form-control" name="minggu[]" style="background:transparent;" value="{{$jadwal!=null?$jadwal->minggu[$i]:''}}"/></td>
                      @endfor
                    </tr>
                  </tbody>
                </form>
                </table>
            </div>
            <div id="footerjadwal" class="card-footer" style="padding: .75rem 3rem;"> 
              @if($detail!=null)
              <button class="btn btn-success" onclick="bukaSimpan()">Edit Jadwal</button>
              @else
               <button class="btn btn-success" style="display: none;" onclick="bukaSimpan()">Edit Jadwal</button>
              @endif
            </div>
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
<script defer>
  $(function () {
    $.validator.setDefaults({});
     $('#formedit').validate({
      rules: {
        pimpinan: {
          maxlength: 50,
        },
        pembimbing: {
          maxlength: 50,
        }
      },
      messages: {
         pimpinan: {
          maxlength: "Mohon isi nama dengan benar!",
        },
        pembimbing: {
          maxlength: "Mohon isi nama dengan benar!",
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
            $('#kd_detail').val(data.kd_detail);
            $('#footerjadwal button').removeAttr('style');
            $('#kd_detail2').val(data.kd_detail);
            pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(3000).fadeOut('slow');
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
    $('#formjadwal').validate({
      rules: {
        senin: {
          time: true,
        },
      },
      messages: {
        senin: {
         time: "Mohon isi jam dengan benar!",
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
            if(data.msg == 'Berhasil menyimpan jadwal PKL!'){
              $('#footerjadwal input').remove();
              $('#footerjadwal').append('<button class="btn btn-success" onclick="bukaSimpan()">Edit Jadwal</button>');
              $('#bodyjadwal input').attr("disabled",'disabled');
              $('#bodyjadwal input').css('background','transparent');
            } 
            pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(3000).fadeOut('slow');
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
        }
      });
      }
    });
   });
function bukaSimpan(){
  $('#footerjadwal button').remove();
   $('#footerjadwal').append('<input type="submit" form="formjadwal" class="btn btn-success" value="Simpan">&nbsp;<input type="button" onclick="reset()" class="btn btn-default" value="Reset">');
   $('#bodyjadwal input').removeAttr('disabled style');
}
  function myFunction() {
    document.getElementById("formedit").reset();
  }
  function reset() {
    document.getElementById("formjadwal").reset();
  }
  function fadeOut(){
    $('#sukses').hide();
 }
</script>
@endsection