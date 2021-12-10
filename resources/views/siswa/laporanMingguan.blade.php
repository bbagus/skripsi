@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Laporan kegiatan')
@section('head')
  <!-- fullCalendar -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/main.css">
@endsection
@section('sidebar')
  @include('layout.sidebarsiswa')
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
          <div class="col-md-3">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                Tambah Laporan Kegiatan
                </h3>
              </div>
              @if($penempatan!=null)
              <div class="card-body">
                <form id="formtambah" class="horizontal" method="POST" action="{{url('/')}}/siswa/laporan-kegiatan/tambah">
                  @csrf
                  <input type="hidden" name="kd_penempatan" value="{{$penempatan!=null?$penempatan->kd_penempatan:''}}"/>
                <div class="form-group mb-3">
                  <label for="tanggal">Hari Tanggal<strong class="text-danger">*</strong></label>
                  <input type="date" class="form-control daterange" name="tanggal">
                </div>
                <div class="form-group row mb-3">
                  <label for="mulai" class="col-12">Waktu<strong class="text-danger">*</strong></label>
                  <input type="time" class="form-control col-4 ml-2" name="mulai" id="mulai"><div class="col-3 text-center ml-1">s.d</div><input type="time" class="form-control col-4 ml-2" name="selesai" id="selesai">
                </div>
                <div class="form-group mb-3">
                  <label for="kegiatan">Kegiatan<strong class="text-danger">*</strong></label>
                  <textarea name="kegiatan" class="form-control" style="height:150px"></textarea>
                </div>
              </form>
              </div>
              <div class="card-footer">
                <input type="submit" form="formtambah" class="btn btn-success" value="Simpan">&nbsp;
                <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
              </div>
            @else
              <div class="card-body p-3">
                <div class="alert alert-danger">
                Pengajuan Anda belum diterima.
                </div>
              </div>
            @endif
            </div>
          </div>
          <!-- col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                 <h3 class="card-title">
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
<!-- fullCalendar 2.2.5 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/main.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/fullcalendar/locales/id.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- jQuery UI -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-ui/jquery-ui.min.js"></script>
<script defer>
  $(function () {
    $.validator.setDefaults({});
    $.validator.addMethod("dateRange", function(value, element, params) {
      try {
        var date = new Date(value);
        if (date >= params.from && date <= params.to) {
          return true;
        }
      } catch (e) {}
      return false;
    }, 'Mohon isi tanggal antara waktu PKL');
    $.validator.addMethod("timeRange", function(value, element, params) {
      try {
        var date = new Date('1970-01-01T'+value.toString());
        var date2 = new Date('1970-01-01T'+time.toString());
        if (date >= date2) {
          return true;
        }
      } catch (e) {}
      return false;
    }, 'Waktu selesai harus lebih besar');
    $.validator.addMethod("timeRange2", function(value, element, params) {
      try {
        var date = new Date('1970-01-01T'+value.toString());
        var date2 = new Date('1970-01-01T'+time2.toString());
        if (date <= date2) {
          return true;
        }
      } catch (e) {}
      return false;
    }, 'Waktu selesai harus lebih besar');
      var fromDate = new Date("2021-01-01");
      var toDate = new Date("2022-12-31");
      var time = '07:00';
      $('#mulai').change(function(){
        time = $(this).val();
      });
      var time2 = '07:00';
      $('#selesai').change(function(){
        time2 = $(this).val();
      });
    $('#formtambah').validate({ 
      rules: {
        tanggal: {
          required: true,
          dateRange: {
            from: fromDate,
            to: toDate
            }
        },
        mulai: {
          required: true, 
          timeRange2: {
            from: time2
          }
        },
        selesai: {
          required: true,
          timeRange: {
            from: time
            } 
        },
        kegiatan: {
          required: true, 
        }
      },
      messages: {
        tanggal: {
          required: "Tanggal harus diisi!",
          dateRange: "Mohon isi tanggal antara waktu PKL "
        },
        mulai: {
          required: "Jam harus diisi!", 
        },
        selesai: {
          required: "Jam harus diisi!", 
        },
        kegiatan: {
          required: "Kegiatan harus diisi!", 
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
            if(data.msg=='Berhasil menambah laporan kegiatan!'){
             pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(3000).fadeOut('slow');
             calendar.refetchEvents();
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
    /* initialize the calendar
     -----------------------------------------------------------------*/
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------
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
      events: '{{url('/')}}/siswa/load-kegiatan'
    });
    calendar.render();
    // $('#calendar').fullCalendar()

  });
function fadeOut(){
  $('#sukses').hide();
}
function myFunction() {
    document.getElementById("formtambah").reset();
  }
</script>
@endsection