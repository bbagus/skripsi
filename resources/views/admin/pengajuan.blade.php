@extends('layout.master')
@section('title', 'SI-PKL : Admin - Pengajuan')
@section('head')
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-dark">
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="Logo SIPKL" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if ($user->foto != 'default.jpg')
        <img src="{{url('/')}}/data_file/{{$user->foto}}" class="img-circle elevation-2" alt="Foto Profil">
        @else
        <img src="{{url('/')}}/data_file/guru-default.jpeg" class="img-circle elevation-2" alt="Foto Profil">
        @endif
      </div>
      <div class="info">
        <a href="/admin/profil" class="d-block">{{$user->nama}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="/admin/" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-siswa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-guru" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru Pembimbing</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item">
            <a href="/admin/kelola-industri" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Industri
              </p>
            </a>
          </li> 
          <li class="nav-header">Proses PKL</li>  
          <li class="nav-item">
            <a href="/admin/kelola-pengajuan" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kelola-penempatan" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Penempatan
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-binoculars"></i>
              <p>
                Monitoring
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-laporan-kegiatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan kegiatan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-laporan-pkl" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan PKL
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-nilai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Nilai
                  </p>
                </a>
              </li>  
            </li>   
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    @endsection
    @section('judul', 'Kelola Pengajuan')
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
                <li class="nav-item"><a id="p1" class="nav-link active" href="#menunggu" data-toggle="tab">Daftar Pengajuan yang Menunggu Diproses</a></li>
                <li class="nav-item"><a id="p2" class="nav-link" href="#sudah" data-toggle="tab">Daftar Pengajuan yang Sudah Diproses</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="menunggu">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Instansi</th>
                        <th>Alamat Instansi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                      </tr>
                      <tr id="filter">
                        <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                        <th><input class="nama form-control" type="text" placeholder="Nama Lengkap" /></th>
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
                        <th><input class="instansi form-control" type="text" placeholder="Instansi" /></th>
                        <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                        <th><input class="tanggal form-control" type="text" placeholder="Tanggal Diproses" /></th>
                        <th><input class="tahun form-control" type="text" placeholder="Tahun Ajaran" /></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pengajuan as $s)
                      <tr>
                        <td style="vertical-align: middle;">{{$s->nis}}</td>
                        <td style="vertical-align: middle;">{{$s->nama}}</td>
                        <td style="vertical-align: middle;">{{$s->kelas}}</td>
                        <td style="vertical-align: middle;">{{ $s->industri}}</td>
                        <td style="vertical-align: middle;">{{ $s->alamat}}</td>
                        <td style="vertical-align: middle;">{{ $s->tgl_pengajuan}}</td>
                        <td style="vertical-align: middle;">{{ $s->tahun_ajaran}}</td>
                        <td style="vertical-align: middle;"width="220px">
                          <form method="POST">
                            {{ csrf_field() }}
                            <a class="btn btn-sm btn-primary" href="{{url('/')}}/admin/kelola-pengajuan/{{$s->kd_pengajuan}}"><i class="fas fa-eye"></i> Detail</a> 
                            <input type="hidden" value="{{$s->kd_pengajuan}}" name="kd">
                            <button type="submit" formaction="{{route('terima')}}" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Terima</button>
                            <button type="submit"  formaction="{{route('tolak')}}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Tolak</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane" id="sudah">
                  <form onSubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data yang ditandai? data penempatan juga akan ikut terhapus')" action="{{route('hapus_pengajuan')}}" method="POST">
                    {{ csrf_field() }}
                    <table id="example2" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>NIS</th>
                          <th>Nama Siswa</th>
                          <th>kelas</th>
                          <th>Instansi</th>
                          <th>Alamat Instansi</th>
                          <th>Tanggal Diproses</th>
                          <th>Tahun Ajaran</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                        <tr id="filter2">
                          <th></th>
                          <th><input class="nis form-control" type="text" placeholder="NIS" /></th>
                          <th><input class="nama form-control" type="text" placeholder="Nama Lengkap" /></th>
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
                          <th><input class="instansi form-control" type="text" placeholder="Instansi" /></th>
                          <th><input class="alamat form-control" type="text" placeholder="Alamat" /></th>
                          <th><input class="tanggal form-control" type="text" placeholder="Tanggal Diproses" /></th>
                          <th><input class="tahun form-control" type="text" placeholder="Tahun Ajaran" /></th>
                          <th><select class="status form-control">
                            <option selected="" value="">Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option></th>
                            <th></th>
                          </tr>
                        </thead>

                      </table>
                      <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-outline-dark btn-small checkbox-toggle"><i class="far fa-square"></i> Tandai Semua
                        </button>
                        <div class="btn-group">
                          <input type="submit" class="btn btn-danger" value="Hapus">
                        </div>
                        <!-- /.btn-group -->
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card-footer">
              </div>
            </div>
            <!-- generate  -->
            <div class="card card-orange">
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <h3 class="card-title text-white">
                 Buat Otomatis Pengajuan Siswa
               </h3>
             </div>
             <div class="card-body" style="padding: 1.75rem 1.75rem;">
                <p class="text-justify">
                Otomatis membuat pengajuan yang sudah disetujui untuk siswa yang belum mengisi form pengajuan (bagian industri kosong).  &nbsp;
                   <a class="btn btn-outline-primary" href="{{url('/')}}/admin/kelola-pengajuan/otomatis"><i class="fas fa-pen"></i> Buat Pengajuan</a>
              </p>
              </div>
           </div>
         </div>
       </div>
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
        $('#example2 input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('#example2 input[type=\'checkbox\']').prop('checked', true)
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
      { "data": "NIS"},
      { "data": "Nama"},
      { "data": "Kelas"},
      { "data": "Instansi" },
      { "data": "Alamat" },
      { "data": "Tanggal Pengajuan" },
      { "data": "Tahun Ajaran" },
      { "data": "Action" }
      ],
      "responsive": true, "lengthChange": true, "searching": true, "autoWidth": false,
      "buttons": [{
            extend: "colvis", className: "btn-info"
          },{
            extend: "print", className: "btn-info"
          }, {
            extend: "pdf", className: "btn-info"
          }, {
            extend: "excel", className: "btn-info"
          }]
    });
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
    $('#filter th').on( 'keyup', 'input.instansi', function () {
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
    $('#filter th').on( 'keyup', 'input.tanggal', function () {
      table
      .columns(5)
      .search($(this).val(), true, false)
      .draw();
    });
    $('#filter th').on( 'keyup', 'input.tahun', function () {
      table
      .columns(6)
      .search($(this).val(), true, false)
      .draw();
    });
var table2 = $('#example2').DataTable();      
    tableConfig = {
      "processing": true,
      "orderCellsTop": true,
      "aoColumnDefs": [
      { "sWidth": "90px", "aTargets": [ 2 ] },
      { "sWidth": "140px", "aTargets": [ 5 ] },
      { "sWidth": "30px", "aTargets": [ 8 ] },
      { "sWidth": "70px", "aTargets": [ 9 ] }
      ],  
      "columns": [
      { "data": null,
      render: function( data, type, row){
        return ' <div class="icheck-primary"><input type="checkbox" name="hapus[]" value="'+data.kd_pengajuan+'" id="'+data.kd_pengajuan+'"><label for="'+data.kd_pengajuan+'"></label></div>';
      }
      },
      { "data": "nis"},
      { "data": "nama"},
      { "data": "kelas"},
      { "data": "industri" },
      { "data": "alamat" },
      { "data": "tgl_diproses" },
      { "data": "tahun_ajaran" },
      { "data": null,
      render: function ( data, type, row ) {
        if (data.status == 'Diterima'){
          return '<button class="btn btn-sm btn-success" disabled>'+data.status+'</span>';
        } else {
          return '<button class="btn btn-sm btn-danger" disabled>'+data.status+'</span>';
        }
        }
      },
      { "data": null,
      render: function ( data, type, row ) {
        return '<a class="btn btn-sm btn-primary" href="{{url('/')}}/admin/kelola-pengajuan/'+ data.kd_pengajuan +'"><i class="fas fa-eye"></i> Detail</a> <a onclick="deleteConfirm(\'/admin/kelola-pengajuan/hapus/'+ data.kd_pengajuan +'\')" href="#!" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>';
      }
        }],
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
      tableConfig.ajax = {
        "url": "{{url('/')}}/admin/kelola-pengajuan-diproses",
        "dataSrc": ""
      };
      table2.destroy();
      table2 = $('#example2').DataTable(tableConfig);
      hitung++;
    }
  })
      //Buat Filter
      $('#filter2 th').on( 'keyup', 'input.nis', function () {
        table2
        .columns(1)
        .search($(this).val(), true, false)
        .draw();
      });
      $('#filter2 th').on( 'keyup', 'input.nama', function () {
        table2
        .columns(2)
        .search($(this).val(), true, false)
        .draw();
      });
      $('#filter2 th').on( 'change', 'select.kelas', function () {
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
      $('#filter2 th').on( 'keyup', 'input.tanggal', function () {
        table2
        .columns(6)
        .search($(this).val(), true, false)
        .draw();
      });
      $('#filter2 th').on( 'keyup', 'input.tahun', function () {
        table2
        .columns(7)
        .search($(this).val(), true, false)
        .draw();
      });
      $('#filter2 th').on( 'change', 'select.status', function () {
        table2
        .columns(8)
        .search($(this).val(), true, false)
        .draw();
      });

  });
function deleteConfirm(url){
  $('#btn-delete').attr('href', url);
  $('#deleteModal').modal();
}
</script>
@endsection