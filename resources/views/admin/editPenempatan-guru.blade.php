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
  <!-- icheck bootstrap -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
           <!-- alert error-->
        <div id="sukses" class="alert alert-dismissible shadow" style="display:none;">
          <button type="button" class="close" onclick="fadeOut()">×</button>
          <div id="pesan">
          </div>
        </div>
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
             <h3 class="card-title">
                <a href="javascript:void(0)" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div><!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" id="truncate" action="{{url
            ('/')}}/admin/kelola-penempatan/guru-hapus" method="POST"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div
            class="card-body" style="padding: 1.75rem 3rem;"> <div  class="form-group row"> 
              <div class="col-sm-1"><p>Nama</p></div>
              <div class="col-sm-1">:</div> 
              <div class="col-sm-10"> <p
                class="">{{$guru->nama}}</p> </div> 
              <div class="col-sm-1"><p>NIP</p></div> 
              <div class="col-sm-1">:</div>
              <div class="col-sm-10"> <p class="">{{$guru->nip}}</p> </div>
              <div class="col-sm-1"><p>Wilayah</p></div> 
              <div class="col-sm-1">:</div>
              <div class="col-sm-10"> <p class="">{{$guru->wilayah}}</p> </div>
              <div><a onclick="tambah()"href="javascript:void(0)" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp; Tambah Siswa Bimbingan</a> </div>
            </div>
              <table id="example1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Instansi</th>
                    <th>Waktu PKL</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
                <!-- /.card-body -->
            <div class="card-footer" style="padding: .75rem 3rem;">
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
        <h4 class="modal-title" id="exampleModalLabel">Tambah siswa bimbingan</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-outline">
          <div class="card-header">
              <ul class="nav nav-pills">
                <li class="nav-item"><a id="p1" class="nav-link active" href="#nis" data-toggle="tab">Cari Nis/Nama</a></li>
                <li class="nav-item"><a class="nav-link" id="p2" href="#kelas" data-toggle="tab">Cari Kelas</a></li>
              </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              {{ csrf_field() }}
              <input type="hidden" name="siswa" id="test" value="">
              <input type="hidden" name="siswa2" id="test2" value="">
              <input type="hidden" name="guru" id="guru" value="{{$guru->kd_pembimbing}}">
              <div class="tab-pane active" id="nis">
                <div class="form-group row">
                  <label for="livesearch" class="col-sm-3 col-form-label">Cari NIS atau nama</label>
                  <div class="col-sm-9">
                    <select class="form-control livesearch" id="siswa" name="livesearch" multiple="multiple" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="kelas">
                <div class="form-group row">
                  <label for="listkelas" class="col-sm-3 col-form-label">Cari berdasarkan kelas</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="listkelas" id="listkelas" style="width: 100%;">
                      <option disabled="" selected="" >Pilih kelas</option>
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
                <div class="form-group row">
                  <label for="listnama" class="col-sm-3 col-form-label">Pilih Siswa</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="listnama" id="listnama" multiple="multiple" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input class="btn btn-success" type="submit" value="Simpan" >
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Siswa akan dihapus dari daftar bimbingan.</div>
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
      <div class="modal-body">Seluruh data yang ditandai akan dihapus dari daftar bimbingan.</div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" value="hapus" class="btn btn-danger" form="truncate"/>
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
</script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script defer>
  var table;
$(document).ready(function () {
   $("#listkelas").change(function() {
    var kelas = $(this).val();
    $('#listnama').select2({
    placeholder: 'pilih siswa',
    ajax: {
      url: '/admin/kelola-penempatan-carisiswa2',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        var queryParameters = {
          q1: params.term,
          q2: kelas
        }
        return queryParameters;
      },
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nis + ' - ' + item.nama +' - '+ item.kelas,
              id: item.nis
            }
          })
        };
      },
      cache: true
    }
  });
 });
  $('#siswa').select2({
    placeholder: 'tulis nis/nama',
    ajax: {
      url: '/admin/kelola-penempatan-carisiswa',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nis + ' - ' + item.nama +' - '+ item.kelas,
              id: item.nis
            }
          })
        };
      },
      cache: true
    }
  });
  table = $("#example1").DataTable({
    "processing": true,
       "ajax": {
        "url": "{{url('/')}}/admin/kelola-penempatan/detail-guru/{{$guru->kd_pembimbing}}",
        "dataSrc": ""
      },
      "columns": [
      {"data": null,
      render: function( data, type, row){
        return  '<div class="icheck-primary"><input type="checkbox" name="hapus[]" value="'+data.kd_penempatan+'" id="'+data.kd_penempatan+'"><label for="'+data.kd_penempatan+'"></label></div>';
      }
      },
      {"data": "nis"},
      {"data": "nama"},
      {"data": "kelas"},
      {"data": "industri"},
      {"data": null,
      render: function( data, type, row){
        return data.tgl_mulai+' s.d '+data.tgl_selesai;
      }
      },
      {"data": null,
      render: function ( data, type, row ) {
        return  '<a class="btn btn-sm btn-success" href="{{url('/')}}/admin/kelola-penempatan/'+data.kd_penempatan+'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-sm btn-danger" onclick="deleteConfirm(\'{{url('/')}}/admin/kelola-penempatan/guru/hapus/'+data.kd_penempatan+'\')" href="javascript:void(0)"><i class="fas fa-trash"></i></a> ';
      }
      }
      ],
      "responsive": true, "lengthChange": true, "autoWidth": false
  });
  $('#tambahsiswa').submit(function(){
    $(this).ajaxSubmit({
      clearForm: true,
      success: function(data){
       $('#listnama').val(null).trigger('change');
       $('#siswa').val(null).trigger('change');
       $('#tambahModal').modal('hide');
       $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
       if(data.msg == 'Berhasil menambahkan siswa!'){
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
  /*ajaxform*/
    $('#truncate').submit(function(){
      $(this).ajaxSubmit({
        success: function(data){
          table.ajax.reload(null, false);
          $('#truncateModal').modal('hide');
          $('#pesan').html('<i class="icon fas fa-exclamation-triangle"></i>'+data.msg);
          if(data.msg != 'Tidak ada yang ditandai'){
           $('#sukses').removeClass('alert-danger').addClass('alert-success').fadeIn().delay(2000).fadeOut('slow');
         } else {
           $('#sukses').removeClass('alert-success').addClass('alert-danger').fadeIn().delay(2000).fadeOut('slow');
         }
         $(window).scrollTop(0);
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
 function tambah(){
  $('#tambahModal').modal();
}
function deleteConfirm(url){
  $('#btn-delete').attr('onclick', 'hapusSiswa("'+url+'")');
  $('#deleteModal').modal();
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
function truncateConfirm(){
    $('#truncateModal').modal();
}
$(function(){
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
    });
    $('#siswa').on('change', function(e) {
      var data = $(this).val();
      $("#test").val(data);
    });
     $('#listnama').on('change', function(e) {
      var data = $(this).val();
      $("#test2").val(data);
    });
});
function goBack() {
  window.history.back();
  if(history.length < 2){
    window.close();
  }
};
function fadeOut(){
    $('#sukses').hide();
}
</script>
@endsection