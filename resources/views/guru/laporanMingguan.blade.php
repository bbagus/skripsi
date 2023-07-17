@extends('layout.master')
@section('title', 'SI-PKL : Guru - Laporan kegiatan')
@section('head')
  <!-- fullCalendar -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/main.css">
@endsection
@section('sidebar')
  @include('layout.sidebarguru')
@endsection
@section('judul', 'Laporan Kegiatan')
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
          <!-- col -->
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
          <!-- /.col -->
           <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header" style="background-color: #094688;">
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
                 <h3 class="card-title text-white">
                Kalender
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
<!-- jQuery UI -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-ui/jquery-ui.min.js"></script>
<script defer>
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
      source = '{{url('/')}}/guru/laporan-kegiatan/'+this.className; 
      this.classList.add('text-primary');
      this.classList.add('mark');
      this.classList.add('nav-link');
      calendar.addEventSource( source );
    });
  });
</script>
@endsection