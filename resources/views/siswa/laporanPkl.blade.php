@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Laporan PKL')
@section('sidebar')
  @include('layout.sidebarsiswa')
@endsection
@section('judul', 'Bimbingan Laporan PKL')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12 px-3">
            <!-- alert error-->
             <div id="sukses" class="alert alert-dismissible shadow" style="display:none;">
              <button type="button" class="close" onclick="fadeOut()">×</button>
              <div id="pesan">
              </div>
             </div>
            <form id="bimbingan" action="{{url('/')}}/siswa/laporan-pkl/tambah" method="POST" enctype="multipart/form-data">
              @csrf
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              @if($penempatan!=null)
               <input type="hidden" value="{{$penempatan->kd_penempatan}}" name="kd_penempatan">
               @if($penempatan->kd_pembimbing==null)
                <div class="alert alert-danger">
                Anda belum mendapat Guru Pembimbing
                </div>
                @else
                @foreach($tgl as $t)
                <div class="time-label">
                  <span class="bg-danger">{{$t}}</span>
                </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
                @foreach($bimbingan as $b)
                @if($t == $b->tgl)
                <div>
                  <i class="fas fa-user {{$b->pengirim==$user->nama?'bg-lightblue':'bg-primary'}}"></i>
                  <div class="timeline-item ">
                    <span class="time text-white"><i class="fas fa-clock"></i> {{$b->jam}}
                    </span>
                    <h3 class="timeline-header {{$b->pengirim==$user->nama?'bg-lightblue':'bg-primary'}}"><a href="javascript:void(0)">{{$b->pengirim}}</a></h3>
                    <p class="timeline-header px-3" >{{$b->judul}}</p>
                    <div class="timeline-body px-3">
                      {{$b->catatan}}
                    </div>
                    @if($b->file!=null)
                    <div class="timeline-footer px-3">
                      <a href="{{url('/')}}/data_file/{{$b->file}}" class="text-dark"><i class="far fa-file-word fa-2x text-primary"></i> {{$b->file}}</a>
                    </div>
                    @endif
                  </div>
                </div>
                @endif
                @endforeach
              @endforeach
              <!-- END timeline item -->
              <div id="tambah" class="time-label pb-3">
                <button onclick="tambahBimbingan('{{$penempatan->kd_penempatan}}')" class="btn btn-small btn-success" style="position:absolute;"><i class="fas fa-plus"></i> tambah bimbingan</button>
              </div>
              @endif
              @else
              <div class="alert alert-danger">
              Pengajuan Anda belum diterima
              </div>
              @endif
              </div>
              </form>
            </div>
          <!-- /.col -->
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
                timeline.append('<div><i class="fas fa-user bg-lightblue"></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> '+data.bimbingan.jam+' </span><h3 class="timeline-header bg-lightblue"><a href="javascript:void(0)">'+data.bimbingan.pengirim+'</a></h3><p class="timeline-header px-3" >'+data.bimbingan.judul+'</p><div class="timeline-body px-3">'+data.bimbingan.catatan+'</div>'+htmlfile+'</div></div>');
                timeline.append('<div id="tambah" class="time-label pt-3"><button onclick="tambahBimbingan(\'{{$penempatan!=null?$penempatan->kd_penempatan:''}}\')" class="btn btn-small btn-success" style="position:absolute;"><i class="fas fa-plus"></i> tambah bimbingan</button></div>');
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
  });

function fadeOut(){
  $('#sukses').hide();
}
function tambahBimbingan(kd_penempatan){
var tambah = $('#tambah');
tambah.removeClass('pt-3')
tambah.html('<i class="fas fa-user bg-lightblue"></i><div class="timeline-item"><h3 class="timeline-header bg-lightblue"><a href="javascript:void(0)">{{$user->nama}}</a></h3><div ><input type="text" class="form-control border-left-0 border-right-0 border-top-0" name="judul" placeholder="tulis judul"></div><div ><textarea class="form-control border-left-0 border-right-0 border-top-0" name="catatan" placeholder="tulis deskripsi" style="height:100px;" ></textarea></div><div class="timeline-footer mx-2"><div class="custom-file"><input name="file" id="files" type="file" style="" accept="application/msword,application/pdf"/></div><input class="btn btn-small btn-success" type="submit"  form="bimbingan" value="Kirim"></div></div>');
};

</script>
@endsection