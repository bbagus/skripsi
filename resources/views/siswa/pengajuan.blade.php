@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Pengajuan PKL')
@section('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
  @include('layout.sidebarsiswa')
@endsection
@section('judul', 'Pengajuan PKL')
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
        <div class="card card-primary card-outline">
          <div class="card-header">
             <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            <h3 class="card-title">
              <a onclick="formPengajuan()" href="javascript:void(0)" class="btn btn-small btn-success"><i class="fas fa-plus"></i> Tambah Pengajuan PKL</a>
            </h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Instansi</th>
                  <th>Alamat</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tahun Ajaran</th>
                  <th>Status</th>
                  <th>Tanggal Diproses</th>
                </tr>
              </thead>
           </table>
         </div>
       </div>
     </div>
   </div>
 </section>
 @endsection
 @section('modal')
 <div class="modal fade" id="formModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:100px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="formpengajuan" class="form-horizontal" action="{{route('tambah_pengajuan')}}" method="POST">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambah Pengajuan PKL</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-3 ml-3 mr-3 mb-3">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="nis" class="col-sm-2 col-form-label">NIS<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nis" value="{{$user->nis}}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label">Tahun Ajaran<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tahunajaran" value="{{$tahunajaran}}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="livesearch" class="col-sm-2 col-form-label">Nama Instansi<strong class="text-danger">*</strong></label>
            <div class="col-sm-10">
              <select class="form-control livesearch" name="livesearch" style="width: 100%;">
              </select>
            </div>
          </div>
          Detail info instansi bisa cek di <a href="{{url('/')}}/industri" target="_blank" rel="noopener noreferrer"> sini</a>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input class="btn btn-success" type="submit" value="Simpan" >
      </div>
    </form>
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
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<script defer>
  var table;
 $(document).ready(function () {
   $(".livesearch").on('select2:open', () => { document.querySelector('.select2-search__field').focus();
 });
   table = $("#example1").DataTable({
    "processing": true,
    "ajax": {
        "url": "{{url('/')}}/siswa/get-pengajuan/",
        "dataSrc": ""
      },
    "columns": [
    { "data": "industri" },
    { "data": "alamat" },
    { "data": "tgl_pengajuan" },
    { "data": "tahun_ajaran" },
    { "data": null,
    render: function( data, type, row){
      var kelas;
     switch (data.status){
      case 'Diterima':
        kelas = 'btn-success';
        break;
      case 'Ditolak':
        kelas = 'btn-danger';
        break;
      default:
      kelas = 'btn-primary';
     }
      return '<span class="btn btn-sm '+kelas+'"> '+data.status+'</span>';
    }
    },
    { "data": "tgl_diproses" }
    ],
    "responsive": true, "lengthChange": false, "searching": false, "autoWidth": false,
    "buttons": []
  });
 });
$.validator.setDefaults({});
 $('#formpengajuan').validate({
  rules: {
    livesearch: {
      required: true,
    },
  },
  messages: {
    livesearch: {
      required: "Instansi harus diisi!",
    },
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
          $('#formModal').modal('hide');
          var pesan = $('#sukses'); 
          $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
          if(data.msg == 'Berhasil menambah pengajuan!'){
            pesan.removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
            table.ajax.reload(null, false);
          } else{
            pesan.removeClass('alert-success').addClass('alert-danger').fadeIn().delay(2000).fadeOut('slow');
          }
          $(window).scrollTop(0);
        },
        error: function (xhr) {
          $('#formModal').modal('hide');
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
  }
});
 function formPengajuan(){
  $('#formModal').modal();
}
$('.livesearch').select2({
    placeholder: 'Pilih Instansi',
    ajax: {
      url: '/siswa/pengajuan/cari',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nama,
              id: item.kd_industri
            }
          })
        };
      },
      cache: true
    }
});
function fadeOut(){
  $('#sukses').hide();
}
</script>
@endsection