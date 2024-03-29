@extends('layout.master')
@section('title', 'SI-PKL : Admin - Monitoring Laporan kegiatan')
@section('head')
  <!-- fullCalendar -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/main.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Monitoring Laporan kegiatan')
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
                <h3 class="card-title">
                Daftar Siswa
                </h3>
              </div> 
              <div class="card-body p-2 overflow-auto"  id="siswa">
                <div class="form-group p-3 row">
                 <select id="kelas" class="kelas form-control select2bs4">
                       <option selected="" value="">Pilih Kelas</option>
                      @foreach ($kelas as $kls)
                        <option value="{{$kls->kd_kelas}}">{{$kls->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group pl-3 pr-3 row">
              	<input type="text" id="cari" placeholder="Cari siswa" class="form-control" name="cari" style="display:none;"/>
                </div>
                 <!--<div class="form-group row">
                  <div class="col-md-5 pl-4" style="vertical-align:bottom;"> Tahun Ajaran</div>
                  <div class="col-md-7">
                    <select id="tahunajar" class="">
                      <option selected value="">Semua</option>
                      <option value="2020/2021">2020/2021</option>
                      <option value="2021/2022">2021/2022</option>
                      <option value="2022/2023" >2022/2023</option>
                      <option value="2023/2024" >2023/2024</option>
                    </select>
                  </div>
                </div> -->
              	<ul id="list" class="nav nav-pills flex-column">
              		<!-- @foreach($siswa as $s)
              		<li class="nav-item">
              			<a href="javascript:void(0)" class="nav-link {{$s->kd_penempatan}}" > {{$s->nama}} {{$s->kelas}}</a><span style="display:none;">{{$s->tahun_ajaran}}</span>
              		</li>
              		@endforeach -->
              	</ul>
              </div>
            </div>
          </div>
          <!-- col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                 <h3 class="card-title">
                Kalender Kegiatan
                </h3>
              </div>
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
<!-- fullCalendar 2.2.5 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/main.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/locales/id.js"></script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery UI -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-ui/jquery-ui.min.js"></script>
<script defer>
$(document).ready(function(){
  $('#tahunajar').on('change', function(){
    var value = $(this).val().toLowerCase();
    $("#list li").filter(function() {
       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  $('#kelas').on('change', function(){
     var kelas = $(this).val();
     $.ajax({
      method: "GET",
      url: '{{url('/')}}/admin/kelola-laporan-kegiatan/loadsiswa/'+kelas,
     }).done(function(data){
      var siswa = data;
      $('#list').html('');
      $('#cari').css('display', 'inline-block');
      siswa.forEach(function(item,index){
        $('#list').append('<li class="nav-item"><a href="javascript:void(0)" class="nav-link '+item.kd_penempatan+' ">'+ item.nama+' '+item.kelas+' </a><span style="display:none;">'+item.tahun_ajaran+'</span></li>');
      });
      if(Object.keys(siswa).length == 0){
         $('#list').append('<li class="nav-item text-center">Data siswa tidak ditemukan.</li>');
      };
     });
  });
	 $("#cari").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#list li").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	 });
});
  $(function(){
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      locale: 'id',
      firstDay: 1,
      allDaySlot: true,
      initialView: 'listMonth',
      navLinks: true,
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      themeSystem: 'bootstrap',
    });
    calendar.render();
    // $('#calendar').fullCalendar()
    var siswa = $('#siswa ul');
    var source;
    siswa.on('click', 'a', function() {
      var header = document.getElementById('siswa');
      var x = header.getElementsByClassName('nav-link');
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('text-primary');
        x[i].classList.remove('mark');
      }
      var eventSources = calendar.getEventSources();
      var len = eventSources.length;
        for (var i = 0; i < len; i++) { 
        eventSources[i].remove(); 
      }
      this.classList.remove('nav-link');
      source = '{{url('/')}}/admin/kelola-laporan-kegiatan/'+this.className; 
      this.classList.add('text-primary');
      this.classList.add('mark');
      this.classList.add('nav-link');
      calendar.addEventSource( source );
    });
  });
</script>
@endsection