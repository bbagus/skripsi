@extends('layout.master')
@section('title', 'SI-PKL : Guru - Siswa Bimbingan')
@section('head')
  <!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebarguru')
@endsection
@section('judul', 'Daftar Siswa Bimbingan')
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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
             <h3 class="card-title">
              </h3>
            </div><!-- /.card-header -->
            <div
            class="card-body" style="padding: 1.75rem 3rem;">
              <table id="example1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>Waktu PKL</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
                <!-- /.card-body -->
            <div class="card-footer" style="padding: .75rem 3rem;">
              <div class="mailbox-controls">
                <!-- /.btn-group -->
              </div>
            </div>
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
@section('modal')
 
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
</script>
<script defer>
  var table;
$(document).ready(function () {
  table = $("#example1").DataTable({
    "processing": true,
       "ajax": {
        "url": "{{url('/')}}/guru/get-siswa/",
        "dataSrc": ""
      },
      "columns": [
      {"data": "nis"},
      {"data": "nama"},
      {"data": "kelas"},
      {"data": "industri"},
      {"data": "alamat"},
      {"data": null,
      render: function( data, type, row){
        return data.tgl_mulai+' s.d '+data.tgl_selesai;
      }
      },
      {"data": null,
      render: function ( data, type, row ) {
        return  '<a class="btn btn-sm btn-primary" href="{{url('/')}}/guru/siswa-bimbingan/'+data.kd_pengajuan+'"><i class="fas fa-eye"></i> Detail</a>';
      }
      }
      ],
      "responsive": true, "lengthChange": true, "autoWidth": false
  }); 
});
function fadeOut(){
    $('#sukses').hide();
}
</script>
@endsection