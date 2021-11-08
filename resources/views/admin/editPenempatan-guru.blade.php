@extends('layout.master')
@section('title', 'SI-PKL : Admin - Edit Penempatan')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebaradmin')
@endsection
  @section('judul', 'Edit Penempatan')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
             <h3 class="card-title">
                <a href="/admin/kelola-penempatan"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div><!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" id="formedit" action="{{url
            ('/')}}/admin/kelola-penempatan/guru/edit" method="POST"
            enctype="multipart/form-data">{{ csrf_field() }} <div
            class="card-body" style="padding: 1.75rem 3rem;"> <div  class="form-group row"> 
              <div class="col-sm-1"><p>Nama</p></div>
              <div class="col-sm-1">:</div> 
              <div class="col-sm-10"> <p
                class="">{{$guru->nama}}</p> </div> 
              <div class="col-sm-1"><p>NIP</p></div> 
              <div class="col-sm-1">:</div>
              <div class="col-sm-10"> <p class="">{{$guru->nip}}</p> </div>
              <div class="col-sm-2"><p>Siswa Bimbingan :</p></div> 
              <div class="col-sm-10"></div>
              <div>  <a onclick="tambah()"href="#" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp; Tambah Siswa Bimbingan</a> </div>
            </div>
              <table id="example1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Instansi</th>
                    <th>Waktu PKL</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($penempatan as $s)
                  <tr>
                    <td style="vertical-align: middle;">{{$s->nis}}</td>
                    <td style="vertical-align: middle;">{{$s->nama}}</td>
                    <td style="vertical-align: middle;">{{$s->kelas}}</td>
                    <td style="vertical-align: middle;">{{$s->industri}}</td>
                    <td style="vertical-align: middle;">{{$s->tgl_mulai}} s.d {{$s->tgl_selesai}}</td>
                    <td style="vertical-align: middle;"width="100px">
                      <a class="btn btn-sm btn-danger" href="{{url('/')}}/admin/kelola-penempatan/guru/hapus/{{$s->kd_penempatan}}"><i class="fas fa-trash"></i></a>
                      <a class="btn btn-sm btn-success" href="{{url('/')}}/admin/kelola-penempatan/siswa/{{$s->kd_penempatan}}"><i class="fas fa-edit"></i></a> 
                    </td>
                  </tr>
                  @endforeach
              </table>
             <!--  <div class="form-group col-sm-4 row">
                <label for="tgl_mulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                <div class="col-sm-8 input-group date">
                  <input type="date" class="form-control" name="tgl_mulai" value="">
                </div>
              </div>
              <div class="form-group col-sm-4 row">
                <label for="tgl_selesai" class="col-sm-4 col-form-label">Tanggal Selesai</label>
                <div class="col-sm-8 input-group date">
                  <input type="date" class="form-control" name="tgl_selesai" value="">
                </div>
              </div> -->
                <!-- /.card-body -->
                <div class="card-footer" style="padding: .75rem 3rem;">
                  
                </div>
              <!-- /.card-footer -->
            </div>
            </form>
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
 <div class="modal fade" id="tambahModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:100px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="tambahsiswa" class="form-horizontal" action="{{url('/')}}/admin/kelola-penempatan/guru/edit" method="POST">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambah Pengajuan PKL</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-3 ml-3 mr-3 mb-3">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="livesearch" class="col-sm-3 col-form-label">Cari berdasarkan nama</label>
            <div class="col-sm-9">
              <select class="form-control livesearch" id="" name="livesearch" multiple="multiple" style="width: 100%;">
              </select>
              <input type="hidden" name="nama" id="test" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="listkelas" class="col-sm-3 col-form-label">Cari berdasarkan kelas</label>
            <div class="col-sm-9">
              <select class="form-control select2bs4" name="listkelas" style="width: 100%;">
                <option disabled="" selected="" hidden="">Pilih kelas</option>
                <option value="1">XI MM 1</option>
                <option value="2">XI MM 2</option>
                <option value="3">XI MM 3</option>
                <option value="4">XI AKL 1</option>
                <option value="5">XI AKL 2</option>
                <option value="6">XI OTKP 1</option>
                <option value="7">XI OTKP 2</option>
                <option value="8">XI BDP 1</option>
                <option value="9">XI BDP 2</option>
                <option value="10">XI TB</option>
                <option value="11">XI PH</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input class="btn btn-success" type="submit" value="Simpan" >
      </div>
    </form>
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
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script defer>
$(document).ready(function () {
   $(".livesearch").on('select2:open', () => { document.querySelector('.select2-search__field').focus();
 });
});

 function tambah(){
  $('#tambahModal').modal();
}
</script>
<script type="text/javascript" defer>
  $('.livesearch').select2({
    placeholder: 'cari siswa',
    ajax: {
      url: '/admin/kelola-penempatan-carisiswa',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nama +' - '+ item.kelas,
              id: item.nis
            }
          })
        };
      },
      cache: true
    }
  });
</script>
@endsection