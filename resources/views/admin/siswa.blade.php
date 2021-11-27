@extends('layout.master')
@section('title', 'SI-PKL : Admin - Data Siswa')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<style>
thead input {
        width: 100%;
    }
</style>
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Kelola Data Siswa')
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
        <!-- /.card -->
        <div class="card card-primary card-outline">
          <!-- form start -->
          <div class="card-header">
            <div class="card-tools">
            </div>
            <h3 class="card-title">
              <a href="/admin/kelola-siswa/tambah" class="btn btn-small btn-success"><i class="fas fa-plus"></i> Tambah siswa</a>
            </h3>
          </div>
          <form action="{{route('hapus_siswa')}}" method="POST" id="truncate">
            {{ csrf_field() }}
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover display">
                <thead>
                  <tr>
                    <th>
                    </th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                  <tr id="filter">
                    <th>
                    </th>
                    <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                    <th><input class="nama form-control" type="text" placeholder="Nama lengkap" /></th>
                    <th><input class="tanggal form-control" type="text" placeholder="Tanggal Lahir" /></th>
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
                    </select></th>
                    <th><input class="telp form-control" type="text" placeholder="No. Telp" /></th>
                    <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
               
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-outline-dark btn-small checkbox-toggle"><i class="far fa-square"></i> Tandai Semua
                </button>
                <div class="btn-group">
                  <a onclick="truncateConfirm()" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                </div>
                <!-- /.btn-group -->
              </div>
            </div>
            <!-- /.card-footer -->
          </form>
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
@section('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak bisa dikembalikan.</div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="javascript:void(0)" onclick="">Hapus</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="truncateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Seluruh data yang ditandai akan dihapus.</div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" value="Hapus" class="btn btn-danger" form="truncate"/>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<!-- jquery form -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-form/jquery.form.min.js"></script>
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
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('#example1 input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('#example1 input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })
  })
  var table;
  $(document).ready(function () {
    table = $("#example1").DataTable({
      "processing": true,
      "orderCellsTop": true,
      "ajax": {
      "url": "{{url('/')}}/admin/get-siswa",
      "dataSrc": ""
      },
       "columnDefs": [
       {"targets": 6, "sWidth": "250px"},
       {"targets": 7, "sWidth": "80px"},
       {"targets": 8, "sWidth": "120px"},
       ],
      "fixedColumns": true,
      "columns": [
      { "data": null,
       render: function ( data, type, row ) {
        return  '<div class="icheck-primary"><input type="checkbox" name="hapus[]" value="'+data.nis+'" id="'+data.nis+'"><label for="'+data.nis+'"></label></div>';
       }
      },
      { "data": "nis" },
      { "data": "nama" },
      { "data": "tgl_lahir" },
      { "data": "kelas" },
      { "data": "telp" },
      { "data": "alamat" },
      { "data": null,
      render: function ( data, type, row ) {
      if(data.foto != 'default.jpg'){
        return '<img class="img-fluid" src="{{url('/')}}/data_file/'+data.foto+'" alt="foto siswa">'
      }  else {
        return '<img class="img-fluid" src="{{url('/')}}/data_file/siswa-default.jpg" alt="foto siswa">'
      } 
      }
      },
      { "data": null,
      render: function ( data, type, row ) {
       return '<a href="{{url('/')}}/admin/kelola-siswa/'+data.nis+'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i>Edit</a> <a onclick="deleteConfirm(\'{{url('/')}}/admin/kelola-siswa/hapus/'+data.nis+'\')" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>';
        }
      }
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
    var filter = $('#filter th');
    filter.on( 'keyup', 'input.nis', function () {
      table
      .columns(1)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.nama', function () {
      table
      .columns(2)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.tanggal', function () {
      table
      .columns(3)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'change', 'select', function () {
      table
      .columns(4)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.telp', function () {
      table
      .columns(5)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.alamat', function () {
      table
      .columns(6)
      .search($(this).val(), true, false)
      .draw();
    });
    /*ajaxform*/
    $('#truncate').submit(function(){
      $(this).ajaxSubmit({
        success: function(data){
          $('#truncateModal').modal('hide');
          $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
          if(data.msg != 'Tidak ada yang ditandai'){
           $('#sukses').removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
          } else {
             $('#sukses').removeClass('alert-success').addClass('alert-danger').fadeIn().delay(2000).fadeOut('slow');
          }
         $(window).scrollTop(0);
         table.ajax.reload(null, false);
        }
      });
      return false;
    });
  });
  function deleteConfirm(url){
    $('#btn-delete').attr('onclick', 'hapusSiswa("'+url+'")');
    $('#deleteModal').modal();
  }
   function truncateConfirm(){
    $('#truncateModal').modal();
  }
  function hapusSiswa(url){
    $.ajax({
      method: "GET",
      url: url
    }).done(function(data){
       $('#deleteModal').modal('hide');
       $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
       $('#sukses').removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
       $(window).scrollTop(0);
       table.ajax.reload(null, false);
    });
  }
function fadeOut(){
  $('#sukses').hide();
}
</script>
@endsection