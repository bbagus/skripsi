@extends('layout.master')
@section('title', 'SI-PKL : Admin - Monitoring Nilai')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
thead input {
        width: 100%;
    }
</style>
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
             <!-- Tabel-->
             <div class="card card-primary card-outline">
               <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
               <div class="form-group row m-2">
                  <div class="col-sm-1" style="vertical-align:bottom;"> Tahun Ajaran</div>
                  <div class="col-sm-2">
                    <select id="tahunajar" class="">
                      <option selected value="">Semua</option>
                      <option value="2020/2021">2020/2021</option>
                      <option value="2021/2022">2021/2022</option>
                      <option value="2022/2023" >2022/2023</option>
                      <option value="2023/2024" >2023/2024</option>
                    </select>
                  </div>
                </div>
            </div>
              <div class="card-body"> 
              <table id="example1" class="table table-bordered table-striped table-hover display">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Program Keahlian</th>
                    <th>Nilai Sikap</th>
                    <th>Nilai Pengetahuan</th>
                    <th>Nilai Keterampilan</th>
                    <th>Tahun Ajaran</th>
                  </tr>
                  <tr id="filter">
                    <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                    <th><input class="nama form-control" type="text" placeholder="Nama lengkap" /></th>
                    <th><select class="kelas form-control select2bs4" style="width: 100%;">
                      <option selected="" value="">Semua</option>
                      @foreach($kelas as $kls)
                      <option value="{{$kls->nama}}">{{$kls->nama}}</option>
                      @endforeach
                    </select></th>
                    <th>
                      <select class="jurusan form-control select2bs4">
                      <option selected="" value="">Semua</option>
                      @foreach ($kelas->unique('jurusan') as $jur)
                      <option value="{{$jur->jurusan}}">{{$jur->jurusan}}</option>
                      @endforeach
                    </select>
                    </th>
                    <th><input class="sikap form-control" type="text" placeholder="Nilai sikap" /></th>
                    <th><input class="pengetahuan form-control" type="text" placeholder="Nilai pengetahuan" /></th>
                    <th><input class="keterampilan form-control" type="text" placeholder="Nilai keterampilan" /></th>
                    <th><input class="tahun form-control" type="text" placeholder="Tahun ajaran" /></th>
                  </tr>
                </thead>
               
              </table>
            </div>
            <!-- /.card-body -->
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
<script defer>
$(document).ready(function(){
   bsCustomFileInput.init();
     //Initialize Select2 Elements
     $('.select2').select2()
     //Initialize Select2 Elements
     $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	var table;
  $(document).ready(function () {
    table = $("#example1").DataTable({
      "processing": true,
      "orderCellsTop": true,
      "ajax": {
      "url": "{{url('/')}}/admin/get-nilai",
      "dataSrc": ""
      },
       "columnDefs": [
       {"targets": 2, "sWidth": "100px"},
       ],
      "fixedColumns": true,
      "columns": [
      { "data": "nis" },
      { "data": "nama" },
      { "data": "kelas" },
      { "data": "jurusan"},
      { "data": "nilai_sikap"},
      { "data": "nilai_pengetahuan"},
      { "data": "nilai_keterampilan"},
      { "data": "tahun_ajaran" }
      ],
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": [{
        extend: "colvis", className: "btn-info"
      },{
        extend: "print", className: "btn-info"
      }, {
        extend: "pdf", className: "btn-info"
      }, {
        extend: "excel", className: "btn-info"
      }],
      initComplete: function () {
        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      }
    });
    $('#tahunajar').on('change', function(){
    table
    .columns(7)
    .search($(this).val(), true, false)
    .draw();
   });
    var filter = $('#filter th');
    filter.on( 'keyup', 'input.nis', function () {
      table
      .columns(0)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.nama', function () {
      table
      .columns(1)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'change', 'select.kelas', function () {
      table
      .columns(2)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'change', 'select.jurusan', function () {
      table
      .columns(3)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.sikap', function () {
      table
      .columns(4)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.pengetahuan', function () {
      table
      .columns(5)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.keterampilan', function () {
      table
      .columns(5)
      .search($(this).val(), true, false)
      .draw();
    });
  });

});
</script>
@endsection