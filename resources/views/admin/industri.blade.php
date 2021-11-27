@extends('layout.master')
@section('title', 'SI-PKL : Admin - Data Industri')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebaradmin')
@endsection
@section('judul', 'Kelola Data Industri')
@section('content')
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
        <!-- /.card -->
        <div class="card card-primary card-outline">
          <!-- form start -->
          <form id="truncate" action="{{route('hapus_industri')}}" method="POST">
            {{ csrf_field() }}
            <div class="card-header">
              <h3 class="card-title">
                <a href="/admin/kelola-industri/tambah" class="btn btn-small btn-success"><i class="fas fa-plus"></i> Tambah Industri</a>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Bidang Kerja</th>
                    <th>Alamat</th>
                    <th>Wilayah</th>
                    <th>Nama Kontak</th>
                    <th>No. Telepon</th>
                    <th>Logo</th>
                    <th>Aksi</th>
                  </tr>
                  <tr id="filter">
                    <th>
                    </th>
                    <th><input class="nama form-control" type="text" placeholder="Nama" /></th>
                    <th><select class="jurusan form-control">
                      <option selected="" value="">Jurusan</option>
                      <option value="Akuntansi Keuangan dan Lembaga">Akuntansi Keuangan dan Lembaga</option>
                      <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                      <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                      <option value="Perhotelan">Perhotelan</option>
                      <option value="Multimedia">Multimedia</option>
                      <option value="Tata Busana">Tata Busana</option>
                    </select></th>
                    <th><input class="bidang form-control" type="text" placeholder="Bidang Kerja" /></th>
                    <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                    <th><input class="wilayah form-control" type="text" placeholder="Wilayah" /></th>
                    <Th><input class="kontak form-control" type="text" placeholder="Nama Kontak" /></th>
                      <th><input class="telp form-control" type="text" placeholder="No. Telepon" /></th>
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
          <a id="btn-delete" class="btn btn-danger"  href="javascript:void(0)" onclick="">Hapus</a>
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
        "url": "{{url('/')}}/admin/get-industri",
        "dataSrc": ""
      },
      "columnDefs": [
       {"targets": 8, "sWidth": "80px"},
       {"targets": 9, "sWidth": "120px"},
       ],
      "fixedColumns": true,
      "columns": [
      { "data": null,
      render: function ( data, type, row ) {
        return  '<div class="icheck-primary"><input type="checkbox" name="hapus[]" value="'+data.kd_industri+'" id="'+data.kd_industri+'"><label for="'+data.kd_industri+'"></label></div>'
        }
      },
      { "data": "nama" },
      { "data": "jurusan" },
      { "data": "bidang_kerja" },
      { "data": "alamat" },
      { "data": "wilayah" },
      { "data": "nama_kontak"},
      { "data": "telp" },
      { "data": null,
      render: function ( data, type, row ) {
          if(data.foto != 'default.jpg'){
            return '<img class="img-fluid" src="{{url('/')}}/data_file/'+data.foto+'" alt="logo industri">'
          }  else {
            return '<img class="img-fluid" src="{{url('/')}}/data_file/industri-default.webp" alt="logo industri default">'
          } 
        }
      },
      { "data": null,
       render: function ( data, type, row ) {
      return '<a href="{{url('/')}}/admin/kelola-industri/'+data.kd_industri+'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i>Edit</a> <a onclick="deleteConfirm(\'{{url('/')}}/admin/kelola-industri/hapus/'+data.kd_industri+'\')" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>';
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
    })
    var filter = $('#filter th');
    filter.on( 'keyup', 'input.nama', function () {
      table
      .columns(1)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'change', 'select', function () {
      table
      .columns(2)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.bidang', function () {
      table
      .columns(3)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.alamat', function () {
      table
      .columns(4)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.wilayah', function () {
      table
      .columns(5)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.kontak', function () {
      table
      .columns(6)
      .search($(this).val(), true, false)
      .draw();
    });
    filter.on( 'keyup', 'input.telp', function () {
      table
      .columns(7)
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
      });
      return false;
    });
  });
 function deleteConfirm(url){
  $('#btn-delete').attr('onclick', 'hapusIndustri("'+url+'")');
  $('#deleteModal').modal();
}
function truncateConfirm(){
    $('#truncateModal').modal();
}
function hapusIndustri(url){
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