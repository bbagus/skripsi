@extends('layout.master')
@section('title', 'SI-PKL : Admin - Monitoring Nilai')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Monitoring Nilai')
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
                <h3 class="card-title">
                Daftar Siswa
                </h3>
              </div>
              <div class="card-body p-2 overflow-auto" style="height:500px;" id="siswa">
              	<input type="text" id="cari" placeholder="Cari siswa" class="form-control" name="cari"/>
              	<ul id="list" class="nav nav-pills flex-column">
              		@foreach($siswa as $s)
              		<li class="nav-item">
              			<a href="javascript:void(0)" class="nav-link {{$s->kd_penempatan}}" > {{$s->nama}} {{$s->kelas}}</a>
              		</li>
              		@endforeach
              	</ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
               <h3 class="card-title">
                Nilai PKL Siswa
              </h3>
            </div>
            <div class="card-body">
                <!-- The time line -->
                 <div id="klik">Klik nama siswa</div>
                 <div id="loading" class="text-center" style="display:none">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div id="timeline">
                </div>
              <!-- /.col -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.timeline -->
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script defer>
$(document).ready(function(){
	 $("#cari").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#list li").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
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
      source = '{{url('/')}}/admin/kelola-nilai/'+kd;
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
        var sikap = data.nilai_sikap!=undefined?data.nilai_sikap:'';
        var pengetahuan = data.nilai_pengetahuan!=undefined?data.nilai_pengetahuan:'';
        var keterampilan = data.nilai_keterampilan!=undefined?data.nilai_keterampilan:'';
         timeline.append('<div class="form-group row"><label for="nilai_sikap" class="col-sm-2 col-form-label">Nilai Sikap</label><div class="col-sm-10"><input disabled type="text" class="form-control"  name="nilai_sikap" id="nilai_sikap" placeholder="belum diisi.." maxlength="3" value="'+sikap+'"></div></div>');
         timeline.append('<div class="form-group row"><label for="nilai_pengetahuan" class="col-sm-2 col-form-label">Nilai Pengetahuan</label><div class="col-sm-10"><input disabled type="text" class="form-control"  name="nilai_pengetahuan" id="nilai_pengetahuan" placeholder="belum diisi.." maxlength="3" value="'+pengetahuan+'"></div></div>');
         timeline.append('<div class="form-group row"><label for="nilai_keterampilan" class="col-sm-2 col-form-label">Nilai Keterampilan</label><div class="col-sm-10"><input disabled type="text" class="form-control"  name="nilai_keterampilan" id="nilai_keterampilan" placeholder="belum diisi.." maxlength="3" value="'+keterampilan+'"></div></div>');
        //endforeach 2x
      });
    });
});
</script>
@endsection