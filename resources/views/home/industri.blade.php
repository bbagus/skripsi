@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
@endsection
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
@auth
  @if (Auth::user()->role == 'admin')
    @include('layout.sidebaradmin')
  @elseif (Auth::user()->role == 'siswa')
    @include('layout.sidebarsiswa')
  @elseif (Auth::user()->role == 'guru')
    @include('layout.sidebarguru')
  @endif
@endauth
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <h2 class="text-center display-4 mb-3">Daftar Industri</h2>
    <div class="callout callout-info bg-gradient-info col-md-8 offset-md-2">
     <h5 class="text-center col-md-10 offset-md-1 p-3">Berikut merupakan daftar industri atau instansi tempat PKL. Anda dapat menemukan informasi seputar tempat industri, bidang kerja, kuota yang disediakan, dan lain lain.</h5>
     <p >
     </p>
     <form action="/industri/cari" method="GET">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Filter Berdasarkan :</label>
                <select class="form-control select2" name="k"  id="first-choice" data-placeholder="Any" style="width: 100%;">
                  @if(isset($search->kolom))
                  <option <?php echo $search->kolom == 'bidang_kerja' ? 'selected' : '' ?> value="bidang_kerja">Bidang kerja</option>
                  <option <?php echo $search->kolom == 'wilayah' ? 'selected' : '' ?> value="wilayah">Wilayah</option>
                  @else
                  <option selected disabled>Pilih filter</option>
                  <option value="bidang_kerja">Bidang kerja</option>
                  <option value="wilayah">Wilayah</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="filter" id="filter">Pilih :</label>
                <select class="select2" id="second-choice" multiple="multiple" name="f" style="width: 100%;" data-placeholder="any">
                  @if(isset($search->filter))
                  @foreach($search->filter as $f)
                  <option selected value="{{$f}}">{{$f}}</option>
                  @endforeach
                  @else
                  <option  disabled value="iki value">Pilih filter dahulu</option>
                  @endif
                </select>
                <input type="hidden" name="test" id="test" value="<?php echo isset($search->test) ? $search->test : ''?>" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-lg">
              <input type="search" name="kk" class="form-control form-control-lg" placeholder="Cari berdasarkan nama instansi" value="<?php echo isset($search->katakunci) ? $search->katakunci : ''?>" >
              <div class="input-group-append">
              </div>
            </div>
          </div>
          <div class="form-group text-center">
           <button type="submit" class="btn btn-lg btn-default">
            Cari &nbsp;<i class="fa fa-search"></i>
          </button>
          @if (isset($teks))
          <button type="button" onClick="window.location.href='/industri';" class="btn btn-lg btn-default ml-2">reset filter &nbsp;<i class="fa fa-sync-alt"></i>
          </button>
          @endif
        </div>
      </div>
    </div>
  </form>
</div>
@if (isset($teks))
<h3 class="text-center mt-5">{{$teks}}
</h3> 
@else
<h2 class="text-center mt-5"></h2>
@endif

<div class="row">
  <div class="col-md-10 offset-md-1 mt-3">
    <!-- /.card -->
    <div class="card card-primary card-outline">
      <!-- form start -->
      {{ csrf_field() }}
      <div class="card-header">
        <h3 class="card-title">

        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Logo</th>
              <th>Nama</th>
              <th>Bidang Kerja</th>
              <th>Wilayah</th>
              <th>Nama Kontak</th>
              <th>No. Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1; ?>
            @foreach ($industri as $s)
            <tr>
              <td>{{$count++}}. </td>
              <td style="vertical-align: middle;padding:0.2rem;" width="100px">
                <img class="img-fluid" src="{{url('/')}}/data_file/{{$s->foto}}" alt="">
              </td>
              <td style="vertical-align: middle;">{{ $s->nama }}</td>
              <td style="vertical-align: middle;">{{ $s->bidang_kerja}}</td>
              <td style="vertical-align: middle;">{{ $s->wilayah}}</td>
              <td style="vertical-align: middle;">{{ $s->nama_kontak}}</td>
              <td style="vertical-align: middle;">{{ $s->telp}}</td>
              <td style="vertical-align: middle;text-align: center;" width="90px" >
                <a href="{{url('/')}}/industri/{{$s->kd_industri}}" class="btn btn-small btn-primary"><i class="fas fa-eye"></i> Detail</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
@endsection
@section('javascript')
<!-- DataTables  & Plugins -->
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/dataTables.buttons.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/pdfmake.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/vfs_fonts.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.html5.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.print.min.js">
</script>
<script src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.colVis.min.js">
</script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script defer>
   $(function () {
    bsCustomFileInput.init();
     //Initialize Select2 Elements
     $('.select2').select2()
     //Initialize Select2 Elements
     $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
   });
  $(document).ready(function () {
    $("#example1").DataTable({
      "processing": true,
      "columns": [
      { "data": "no" },
      { "data": "foto" },
      { "data": "nama" },
      { "data": "bidang_kerja" },
      { "data": "wilayah" },
      { "data": "nama_kontak" },
      { "data": "telp" },
      { "data": "aksi"}
      ],
      "responsive": true, "lengthChange": true, "autoWidth": false,"searching": true,
      "buttons": [{
        extend: "colvis", className: "btn-info"
    }]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  $("#first-choice").change(function() {
  var $dropdown = $(this);
  $.getJSON("{{url('/')}}/data_file/filter.json", function(data) {
    var key = $dropdown.val();
    var vals = [];      
    switch(key) {
      case 'bidang_kerja':
        vals = data.bidang_kerja.split(",");
         document.getElementById('filter').innerHTML
                = 'Pilih Bidang kerja :';
        break;
      case 'wilayah':
        vals = data.wilayah.split(",");
        document.getElementById('filter').innerHTML
                = 'Pilih Wilayah :';
        break;
      case 'base':
        vals = ['Please choose from above'];
    }
    var $secondChoice = $("#second-choice");
    $secondChoice.empty();
    $.each(vals, function(index, value) {
      $secondChoice.append("<option value='"+ value + "'>" + value + "</option>");
    });
  });
});
$(function(){
  // turn the element to select2 select style
  $('#second-choice').on('change', function(e) {
    var data = $(this).val();
    $("#test").val(data);
  });
});
</script>
@endsection