@extends('layout.master')
@section('title', 'SI-PKL : Admin - Info')
@section('head')
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Kelola Pengumuman')
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
      </div>
      <div class="col-md-3">
        <a href="/admin/kelola-informasi/tambah" class="btn btn-success btn-block mb-3"><i class="fa fa-edit"></i> Buat Pengumuman</a>

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Status</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0" id="status">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a href="#" class="nav-link all text-primary"><i class="fa fa-list-ul"></i> Semua</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-paper-plane"></i> Diumumkan</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-file-alt"></i> Draf</a>
              </li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-save"></i> Disimpan</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card card-orange">
          <div class="card-header">
            <h3 class="card-title text-white">Label</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus text-white"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0" id="label">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a href="#" class="nav-link all text-primary" ><i class="far fa-circle text-primary"></i> Semua</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" ><i class="far fa-circle text-danger"></i> Pengajuan</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-circle text-warning"></i> Laporan</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" ><i class="far fa-circle text-info"></i> Tips</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" ><i class="far fa-circle text-grey"></i> Lain-lain</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <form onSubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data yang ditandai?')" action="{{route('hapus_info')}}" method="POST">
            {{ csrf_field() }}
            <div class="card-header">
              <h3 class="card-title">List Pengumuman</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive mailbox-messages" style="padding: .5rem;">
                <table id="example1" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Judul</th>
                      <th>Penulis</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Label</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($info as $info)
                    <tr>
                      <td style="vertical-align: middle;max-width: 30px;">
                        <div class="icheck-primary">
                          <input type="checkbox" name="hapus[]" value="{{$info->kd_info}}" id="{{$info->kd_info}}">
                          <label for="{{$info->kd_info}}"></label>
                        </div>
                      </td>
                      <td class="mailbox-name" style="vertical-align: middle;max-width:400px;">
                        <a href="#">{{$info->judul}}</a>
                      </td>
                      <td style="vertical-align: middle;" class="mailbox-subject" style="vertical-align: middle;">{{$info->penulis}}
                      </td>
                      <td style="vertical-align: middle;" class="mailbox-date">{{$info->tanggal}}</td>
                      <td style="vertical-align: middle;" class="">{{$info->status}}</td>
                      <td style="vertical-align: middle;" class="">{{$info->nama}}</td>
                      <td style="vertical-align: middle;" width="100px" >
                        <a href="{{url('/')}}/admin/kelola-informasi/{{$info->kd_info}}" class="btn btn-small btn-success" title="edit" ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a onclick="deleteConfirm('{{url('/')}}/admin/kelola-informasi/hapus/{{$info->kd_info}}')" href="#!" class="btn btn-small btn-danger" title="hapus" ><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls ml-3">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" title="tandai semua">
                  <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="submit" class="btn btn-default btn-sm" title="hapus">
                    <i class="far fa-trash-alt text-danger"></i>
                  </button>
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</section>
<!-- /.content -->
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
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/dataTables.buttons.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/jszip/jszip.min.js"></script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/pdfmake.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/pdfmake/vfs_fonts.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.html5.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.print.min.js">
</script>
<script defer src="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/js/buttons.colVis.min.js">
</script>
<script defer>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })
    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var far   = $this.hasClass('far')
      var fas   = $this.hasClass('fas')

      //Switch states
      if (far) {
        $this.toggleClass('far fa-star')
        $this.toggleClass('fas fa-star')
      } else if (fas) {
        $this.toggleClass('far fa-star')
        $this.toggleClass('fas fa-star')
      }
    })
  })
  $(document).ready(function () {
    var table = $("#example1").DataTable({
      "processing": true,
      "columns": [
      { "data": "checkbox"},
      { "data": "judul" },
      { "data": "penulis" },
      { "data": "tanggal" },
      { "data": "status" },
      { "data": "label" },
      { "data": "aksi"}
      ],
      "ordering": false, "responsive": true, "lengthChange": true, "autoWidth": false,
      "language": {"searchPlaceholder":"Cari Pengumuman" }
    });
    var label =  $('#label ul');
    label.on( 'click', 'a', function () {
      var header = document.getElementById('label');
      var x = header.getElementsByClassName('nav-link');
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('text-primary');
      }
      this.classList.add('text-primary');
      table
      .columns(5)
      .search( $(this).text() )
      .draw();
    });
    label.on( 'click', 'a.all', function () {
      table
      .search('')
      .columns(5)
      .search('')
      .draw();
    });
    var status =  $('#status ul');
    status.on( 'click', 'a', function () {
      var header = document.getElementById('status');
      var x = header.getElementsByClassName('nav-link');
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('text-primary');
      }
      this.classList.add('text-primary');
      table
      .columns(4)
      .search( $(this).text() )
      .draw();
    })
    status.on( 'click', 'a.all', function () {
      table
      .search('')
      .columns(4)
      .search('')
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