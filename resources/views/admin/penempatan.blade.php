@extends('layout.master')
@section('title', 'SI-PKL : Admin - Penempatan')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Kelola Penempatan')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
       <div class="col-12">
         @if(count($errors) > 0)
           <div class="alert alert-danger alert-dismissible shadow">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-exclamation-triangle"></i>
            @foreach ($errors->all() as $error)
            {{ $error }} <br/>
            @endforeach
          </div>
          @endif
          @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible shadow">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-exclamation-triangle"></i>
            {!! \Session::get('success') !!}
          </div>
          @endif
           <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <ul class="nav nav-pills">
                <li class="nav-item"><a id="p1" class="nav-link active" href="#siswa" data-toggle="tab">Lihat berdasarkan Siswa</a></li>
                <li class="nav-item"><a class="nav-link" id="p2" href="#guru" data-toggle="tab">Lihat berdasarkan Guru Pembimbing</a></li>
                <li class="nav-item"><a class="nav-link" id="p3" href="#industri" data-toggle="tab">Lihat berdasarkan Industri</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content mb-3">
                <div class="tab-pane active" id="siswa">
                  <div class="form-group row">
                  <div class="col-sm-1" style="vertical-align:bottom;"> Tahun Ajaran</div>
                  <div class="col-sm-2">
                    <select id="tahunajar" class="">
                      <option >2020/2021</option>
                      <option selected="">2021/2022</option>
                      <option >2022/2023</option>
                    </select>
                  </div>
                </div>
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Guru Pembimbing</th>
                    <th>Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>Waktu PKL</th>
                    <th>Aksi</th>
                  </tr>
                  <tr id="filter">
                    <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                    <th><input class="nama form-control" type="text" placeholder="Nama Siswa" /></th>
                    <th><select class="kelas form-control">
                          <option selected="" value="">Kelas</option>
                          <option value="XI MM 1">XI MM 1</option>
                          <option value="XI MM 2">XI MM 2</option>
                          <option value="XI MM 3">XI MM 3</option>
                          <option value="XI AKL 1">XI AKL 1</option>
                          <option value="XI AKL 2">XI AKL 2</option>
                          <option value="XI OTKP 1">XI OTKP 1</option>
                          <option value="XI OTKP 2">XI OTKP 2</option>
                          <option value="XI BDP 1">XI BDP 1</option>
                          <option value="XI BDP 2">XI BDP 2</option>
                          <option value="XI TB">XI TB</option>
                          <option value="XI PH">XI PH</option>
                        </select>
                    </th>
                    <th><input class="guru form-control" type="text" placeholder="Guru Pembimbing" /></th>
                    <th><input class="instansi form-control" type="text" placeholder="Instansi" /></th>
                    <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                    <th><input class="waktu form-control" type="text" placeholder="Waktu PKL" /></th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane" id="guru">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Guru Pembimbing</th>
                    <th>Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>Waktu PKL</th>
                    <th>Aksi</th>
                  </tr>
                  <tr id="filter2">
                    <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                    <th><input class="nama form-control" type="text" placeholder="Nama Siswa" /></th>
                    <th><select class="kelas form-control">
                          <option selected="" value="">Kelas</option>
                          <option value="XI MM 1">XI MM 1</option>
                          <option value="XI MM 2">XI MM 2</option>
                          <option value="XI MM 3">XI MM 3</option>
                          <option value="XI AKL 1">XI AKL 1</option>
                          <option value="XI AKL 2">XI AKL 2</option>
                          <option value="XI OTKP 1">XI OTKP 1</option>
                          <option value="XI OTKP 2">XI OTKP 2</option>
                          <option value="XI BDP 1">XI BDP 1</option>
                          <option value="XI BDP 2">XI BDP 2</option>
                          <option value="XI TB">XI TB</option>
                          <option value="XI PH">XI PH</option>
                        </select>
                    </th>
                    <th><input class="guru form-control" type="text" placeholder="Guru Pembimbing" /></th>
                    <th><input class="instansi form-control" type="text" placeholder="Instansi" /></th>
                    <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                    <th><input class="waktu form-control" type="text" placeholder="Waktu PKL" /></th>
                    <th></th>
                  </tr>
                </thead>       
              </table>
            </div>
            <div class="tab-pane" id="industri">
              <table id="example3" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Guru Pembimbing</th>
                    <th>Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                  </tr>
                  <tr id="filter3">
                    <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                    <th><input class="nama form-control" type="text" placeholder="Nama Siswa" /></th>
                    <th><select class="kelas form-control">
                          <option selected="" value="">Kelas</option>
                          <option value="XI MM 1">XI MM 1</option>
                          <option value="XI MM 2">XI MM 2</option>
                          <option value="XI MM 3">XI MM 3</option>
                          <option value="XI AKL 1">XI AKL 1</option>
                          <option value="XI AKL 2">XI AKL 2</option>
                          <option value="XI OTKP 1">XI OTKP 1</option>
                          <option value="XI OTKP 2">XI OTKP 2</option>
                          <option value="XI BDP 1">XI BDP 1</option>
                          <option value="XI BDP 2">XI BDP 2</option>
                          <option value="XI TB">XI TB</option>
                          <option value="XI PH">XI PH</option>
                        </select>
                    </th>
                    <th><input class="guru form-control" type="text" placeholder="Guru Pembimbing" /></th>
                    <th><input class="instansi form-control" type="text" placeholder="Instansi" /></th>
                    <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                    <th><input class="waktu form-control" type="text" placeholder="Waktu PKL" /></th>
                    <th></th>
                  </tr>
                </thead>
                
              </table>
            </div>
          </div>
       </div>
     </div>
   </div>
 </section>

 @endsection
 @section('modal')
 
@endsection
@section('javascript')
<!-- DataTables  & Plugins -->
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/dataTables.responsive.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/responsive.bootstrap4.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/dataTables.buttons.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.bootstrap4.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/jszip/jszip.min.js" ></script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/pdfmake.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/vfs_fonts.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.html5.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.print.min.js" >
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.colVis.min.js" >
</script>
<script defer >
$(document).ready(function () {
   var table = $("#example1").DataTable({
    "processing": true,
    "orderCellsTop": true,
    "deferRender":true,
    "language": {
      "emptyTable": "Buat data pengajuan dahulu agar dapat mengelola penempatan",
    },
    "ajax": {
      "url": "{{url('/')}}/admin/kelola-penempatan-siswa",
      "dataSrc": ""
  },
  "columnDefs": [
    {"targets": 7, "sWidth": "50px"}
  ],
    "columns": [
    { "data": "nis"},
    { "data": "nama"},
    { "data": "kelas"},
    { "data": "guru"},
    { "data": "industri" },
    { "data": "alamat" },
    { "data": null,
    render: function ( data, type, row ) {
      if(data.tgl_mulai != null){
        return data.tgl_mulai +' s.d '+ data.tgl_selesai;
      }
      } 
    },
    { "data": null,
      render: function ( data, type, row ) {
        return '<a class="btn btn-sm btn-success" href="{{url('/')}}/admin/kelola-penempatan/'+ data.kd_penempatan +'"><i class="fas fa-edit"></i> Edit</a>';
      }
    }],
    "order": [[ 4, "desc" ]],
    "responsive": true, "lengthChange": true, "searching": true, "autoWidth": false,
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
   $('#tahunajar').on('change', 'select', function(){
    table.clear()
    .draw();
   });
   $('#filter th').on( 'keyup', 'input.nis', function () {
    table
    .columns(0)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'keyup', 'input.nama', function () {
    table
    .columns(1)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'change', 'select', function () {
    table
    .columns(2)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'keyup', 'input.guru', function () {
    table
    .columns(3)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'keyup', 'input.instansi', function () {
    table
    .columns(4)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'keyup', 'input.alamat', function () {
    table
    .columns(5)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter th').on( 'keyup', 'input.waktu', function () {
    table
    .columns(6)
    .search($(this).val(), true, false)
    .draw();
  });
  var table2 = $('#example2').DataTable();
   tableConfig2 = {
    "processing": true,
    "orderCellsTop": true,  
    "language": {
      "emptyTable": "Buat data pengajuan dahulu agar dapat mengelola penempatan",
    },
    "columnDefs": [{
      "targets": '_all',
      "defaultContent": "" },
      {"targets": 5, "sWidth": "140px"},
      {"targets": 7, "sWidth": "30px"},
      {"targets": 3, "visible": false}
    ],
    "drawCallback": function ( settings ) {
      var api = this.api();
      var rows = api.rows( {page:'current'} ).nodes();
      var last=null;
      api.column(3, {page:'current'} ).data().each( function ( group, i ) {
        if ( last !== group ) {
          $(rows).eq( i ).before(
            '<tr class="group" style="background-color:#ddd;"><td colspan="6">'+group+'</td><td><a class="btn btn-sm btn-success" href="{{url('/')}}/admin/kelola-penempatan/guru/'+group .toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "")+'"><i class="fas fa-edit"></i> Edit</a></td></tr>'
            );
          last = group;
        }
      } );
    }, 
    "columns": [
    { "data": "nis"},
    { "data": "nama"},
    { "data": "kelas"},
    { "data": "guru"},
    { "data": "industri" },
    { "data": "alamat" },
    { "data": null,
    render: function ( data, type, row ) {
      if(data.tgl_mulai != null){
        return data.tgl_mulai +' s.d '+ data.tgl_selesai;
      }
      } 
    },
    { "data": "Action" }],
    "responsive": true, "lengthChange": true, "searching": true, "autoWidth": false,  
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
        table2.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
      }
  };
  hitung = 0;
  $('#p2').click(function() {
    if (hitung < 1){
      tableConfig2.ajax = {
        "url": "{{url('/')}}/admin/kelola-penempatan-guru",
        "dataSrc": ""
      };
      table2.destroy();
      table2 = $('#example2').DataTable(tableConfig2);
      hitung++;
    }
  });
  $('#filter2 th').on( 'keyup', 'input.nis', function () {
    table2
    .columns(0)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'keyup', 'input.nama', function () {
    table2
    .columns(1)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'change', 'select', function () {
    table2
    .columns(2)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'keyup', 'input.guru', function () {
    table2
    .columns(3)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'keyup', 'input.instansi', function () {
    table2
    .columns(4)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'keyup', 'input.alamat', function () {
    table2
    .columns(5)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter2 th').on( 'keyup', 'input.waktu', function () {
    table2
    .columns(6)
    .search($(this).val(), true, false)
    .draw();
  });
var table3 = $('#example3').DataTable();
   tableConfig3 = {
    "processing": true,
    "orderCellsTop": true,  
    "language": {
      "emptyTable": "Buat data pengajuan dahulu agar dapat mengelola penempatan",
    },
    "columnDefs": [{
      "targets": '_all',
      "defaultContent": "" },
      {"targets": 5, "sWidth": "140px"},
      {"targets": 7, "sWidth": "30px"},
      {"targets": 4, "visible": false}
    ],
    "drawCallback": function ( settings ) {
      var api = this.api();
      var rows = api.rows( {page:'current'} ).nodes();
      var last=null;
      api.column(4, {page:'current'} ).data().each( function ( group, i ) {
        if ( last !== group ) {
          $(rows).eq( i ).before(
            '<tr class="group" style="background-color:#ddd;"><td colspan="6">'+group+'</td><td><a class="btn btn-sm btn-success" href="{{url('/')}}/admin/kelola-penempatan/instansi/'+group .toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "")+'"><i class="fas fa-edit"></i> Edit</a></td></tr>'
            );
          last = group;
        }
      } );
    }, 
    "columns": [
    { "data": "nis"},
    { "data": "nama"},
    { "data": "kelas"},
    { "data": "guru"},
    { "data": "industri" },
    { "data": "alamat" },
    { "data": null,
    render: function ( data, type, row ) {
      if(data.tgl_mulai != null){
        return data.tgl_mulai +' s.d '+ data.tgl_selesai;
      }
      } 
    },
    { "data": "Action" }],
    "responsive": true, "lengthChange": true, "searching": true, "autoWidth": false,  
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
        table3.buttons().container()
        .appendTo('#example3_wrapper .col-md-6:eq(0)');
      }
  };
  hitung2 = 0;
  $('#p3').click(function() {
    if (hitung2 < 1){
      tableConfig3.ajax = {
        "url": "{{url('/')}}/admin/kelola-penempatan-industri",
        "dataSrc": ""
      };
      table3.destroy();
      table3 = $('#example3').DataTable(tableConfig3);
      hitung2++;
    }
  });
  $('#filter3 th').on( 'keyup', 'input.nis', function () {
    table3
    .columns(0)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'keyup', 'input.nama', function () {
    table3
    .columns(1)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'change', 'select', function () {
    table3
    .columns(2)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'keyup', 'input.guru', function () {
    table3
    .columns(3)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'keyup', 'input.instansi', function () {
    table3
    .columns(4)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'keyup', 'input.alamat', function () {
    table3
    .columns(5)
    .search($(this).val(), true, false)
    .draw();
  });
   $('#filter3 th').on( 'keyup', 'input.waktu', function () {
    table3
    .columns(6)
    .search($(this).val(), true, false)
    .draw();
  });
});
</script>
@endsection