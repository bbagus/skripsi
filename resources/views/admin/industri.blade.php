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
        <!-- /.card -->
        <div class="card card-primary card-outline">
          <!-- form start -->
          <form onSubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data yang ditandai?')" action="{{route('hapus_industri')}}" method="POST">
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
                  <tbody>
                    @foreach ($industri as $s)
                    <tr>
                      <td style="vertical-align: middle;" width="30px">
                        <div class="icheck-primary">
                          <input type="checkbox" name="hapus[]" value="{{$s->kd_industri}}" id="{{$s->kd_industri}}">
                          <label for="{{$s->kd_industri}}"></label>
                        </div>
                      </td>
                      <td style="vertical-align: middle;">{{ $s->nama }}</td>
                      <td style="vertical-align: middle;">{{ $s->jurusan}}</td>
                      <td style="vertical-align: middle;">{{ $s->bidang_kerja}}</td>
                      <td style="vertical-align: middle;max-width: 350px;">{{ $s->alamat}}</td>
                      <td style="vertical-align: middle;">{{ $s->wilayah}}</td>
                      <td style="vertical-align: middle;">{{ $s->nama_kontak}}</td>
                      <td style="vertical-align: middle;">{{ $s->telp}}</td>
                      <td style="vertical-align: middle;padding:0.2rem;" width="100px">
                        @if($s->foto != 'default.jpg')
                        <img class="img-fluid" src="{{url('/')}}/data_file/{{$s->foto}}" alt="">
                        @else
                        <img class="img-fluid" src="{{url('/')}}/data_file/industri-default.png" alt="">
                        @endif
                      </td>
                      <td style="vertical-align: middle;" width="160px" >
                        <a href="{{url('/')}}/admin/kelola-industri/{{$s->kd_industri}}" class="btn btn-small btn-success"><i class="fas fa-edit"></i>Edit</a>
                        <a onclick="deleteConfirm('{{url('/')}}/admin/kelola-industri/hapus/{{$s->kd_industri}}')" href="#!" class="btn btn-small btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-outline-dark btn-small checkbox-toggle"><i class="far fa-square"></i> Tandai Semua
                  </button>
                  <div class="btn-group">
                    <input type="submit" class="btn btn-danger" value="Hapus">
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
        </div>
      </div>
    </div>
  </div>
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
    <script>
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
     $(document).ready(function () {
      var table = $("#example1").DataTable({
        "processing": true,
        "orderCellsTop": true,
        "columns": [
        { "data": "checkbox"},
        { "data": "nama" },
        { "data": "jurusan" },
        { "data": "bidang_kerja" },
        { "data": "alamat" },
        { "data": "wilayah" },
        { "data": "nama_kontak"},
        { "data": "telp" },
        { "data": "foto" },
        { "data": "aksi"}
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
    }]
    })
      table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
     $('#filter th').on( 'keyup', 'input.bidang', function () {
          table
          .columns(3)
          .search($(this).val(), true, false)
          .draw();
        });
     $('#filter th').on( 'keyup', 'input.alamat', function () {
          table
          .columns(4)
          .search($(this).val(), true, false)
          .draw();
        });
     $('#filter th').on( 'keyup', 'input.wilayah', function () {
          table
          .columns(5)
          .search($(this).val(), true, false)
          .draw();
        });
     $('#filter th').on( 'keyup', 'input.kontak', function () {
          table
          .columns(6)
          .search($(this).val(), true, false)
          .draw();
        });
     $('#filter th').on( 'keyup', 'input.telp', function () {
          table
          .columns(7)
          .search($(this).val(), true, false)
          .draw();
        });
      });
  </script>
  <script defer>
    function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    }
  </script>
  @endsection