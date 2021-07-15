@extends('layout.master')
@section('title', 'SI-PKL : Tambah Data Siswa')
@section('head')
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}/AdminLTE-master/index3.html" class="brand-link navbar-primary">
      <img src="{{url('/')}}/AdminLTE-master/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/')}}/AdminLTE-master/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
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
            <a href="/admin/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Kelola Data</li>  
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li> 
          <li class="nav-item menu-is-opening menu-open">
            <a href="/admin/kelola-informasi" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-siswa" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru Pembimbing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembimbing DU/DI</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Industri
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Berkas/Template
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-id-badge"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          <li class="nav-header">Proses PKL</li>  
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link">
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
                <a href="/admin/kelola-informasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  laporan mingguan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-informasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  laporan PKL
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-informasi" class="nav-link">
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
@section('judul', 'Mengubah Data Siswa')
@section('content')
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
<!-- general form elements -->
         @if(count($errors) > 0)
            <div class="alert {{$isiclass}} alert-dismissible shadow">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-exclamation-triangle"></i>
                @foreach ($errors->all() as $error)
                {{ $error }} <br/>
                @endforeach
            </div>
        @endif
        @if($pesan != '')
        <div class="alert {{$isiclass}} alert-dismissible shadow">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-exclamation-triangle"></i> {{$pesan}}
        </div>
        @endif
            <div class="card card-info" >
              <div class="card-header">
                <h3 class="card-title">
                  <a href="/admin/kelola-siswa"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="formsiswa" action="{{route('proses_edit')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="nislama" value="{{$siswa->nis}}" />

                <div class="card-body" style="padding: 1.75rem 5rem;">
                  <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Siswa<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis nomor induk siswa.." value="{{$siswa->nis}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." value="{{$siswa->nama}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9 input-group date">
                        <input type="date" class="form-control datetimepicker-input" name="tgl_lahir" value="{{$siswa->tgl_lahir}}"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <select class="form-control col-form-label" name="kd_kelas">

                        <option <?php echo $siswa->kd_kelas == '1' ? 'selected': '' ?> value="1">XI MM 1</option>
                        <option <?php echo $siswa->kd_kelas == '2' ? 'selected': '' ?> value="2">XI MM 2</option>
                      </select>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-9">
                      <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." value="{{$siswa->telp}}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <textarea type="text" name="alamat" class="form-control" id="telp" placeholder="Tulis alamat lengkap.."s>{{$siswa->alamat}}</textarea>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-9">
                      @if($siswa->foto != 'default.jpg')
                      <img class="img-fluid mb-3" style="width: 150px;float:left;" src="{{url('/')}}/data_file/{{$siswa->foto}}" alt="">
                      <a class="close" title="hapus foto" style="float: left;
margin-left: 5px;" href="{{url('/')}}/admin/kelola-siswa/hapus-foto/{{$siswa->nis}}">x</a>
                      @endif
                      <input type="hidden" name="ganti" value="{{$isiclass}}" />
                      <input class="form-control-file" type="file" name="foto">
                      <font color="red">
                      Ukuran file maksimal 700 KB.<br>
                      Format file : jpg, jpeg, png.
                    </font>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="padding: .75rem 5rem;">
                  <input type="submit" class="btn btn-success" value="Simpan">
                  &nbsp;
                  <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
@endsection
@section('javascript')
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  $.validator.setDefaults({});
  $('#formsiswa').validate({
    rules: {
      nis: {
        required: true,
        number: true,
      },
      nama: {
        required: true,
      },
      tgl_lahir: {
        required: true,
        date: true,
      },
      kd_kelas: {
        required: true,
      }
    },
    messages: {
      nis: {
        required: "NIS harus diisi",
        number: "Mohon isi NIS dengan benar"
      },
      nama: {
        required: "Nama lengkap harus diisi",
      },
      
      tgl_lahir: {
        required: "Tanggal lahir harus diisi",
        date: "Mohon isi tanggal dengan benar"
      },
      kd_kelas: {
        required: "Kelas harus diisi",
      }
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
    }
  });
});
function myFunction() {
  document.getElementById("formsiswa").reset();
}
</script>
@endsection
