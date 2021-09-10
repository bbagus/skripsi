@extends('layout.master')
@section('title', 'SI-PKL : Tambah Data Siswa')
@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
            <a href="/admin/kelola-informasi" class="nav-link active">
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
            <a href="/admin/kelola-pengajuan" class="nav-link">
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
            <a href="/admin/kelola-monitoring" class="nav-link">
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
    @section('judul', 'Menambah Data Siswa')
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
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card card-info" >
              <div class="card-header">
                <h3 class="card-title">
                  <a href="/admin/kelola-siswa"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="formsiswa" action="{{route('proses_upload')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body" style="padding: 1.75rem 3rem;">
                  <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Siswa<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis nomor induk siswa.." maxlength="15">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10 input-group date">
                      <input type="date" class="form-control" name="tgl_lahir">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" name="kd_kelas" style="width: 100%;">
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
                  <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." maxlength="20">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea type="text" name="alamat" class="form-control" id="telp" placeholder="Tulis alamat lengkap.." maxlength="255"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
                      <div class="custom-file">
                      <input class="custom-file-input" type="file" name="foto" accept="image/png, image/jpeg" id="customFile" >
                     <label class="custom-file-label" for="customFile">Pilih file</label>
                      <font color="red">
                        Ukuran file maksimal 700 KB.<br>
                        Format file : jpg, jpeg, png.
                      </font>
                    </div>
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
          <div class="col-md-3">
            <div class="card card-orange">
              <div class="card-header ">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus text-white"></i>
                  </button>
                </div>
                <h3 class="card-title text-white">
                  Keterangan
                </h3>
              </div>
              <div class="card-body" style="padding: 1.75rem 1.75rem;">
                <p class="text-justify">
                Dengan menambahkan data siswa baru, maka akun untuk siswa otomatis akan dibuat dengan informasi akses :<br>
                <div class="row">
                  <div class="col-4">Username</div>
                  <div class="col-1">:</div>
                  <div class="col-6">Nomor Induk Siswa</div>
                  <div class="col-4">Password</div>
                  <div class="col-1">:</div>
                  <div class="col-6">Tanggal lahir. Format "ddmmyyyy"</div>
                </div>
              </p>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header ">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus text-white"></i>
                  </button>
                </div>
                <h3 class="card-title text-white">
                  Import Data
                </h3>
              </div>
              <div class="card-body" style="padding: 1.75rem 1.75rem;">
                <p class="text-justify">
                Dapat menambahkan data siswa secara sekaligus menggunakan file berekstensi *.xls atau*.xlsx. File yang diunggah harus sesuai format file excel berikut :<br></p>
                <div class="form-group">
                   <a class="btn btn-block btn-outline-primary" href="#"><i class="fas fa-download"></i> TEMPLATE FILE EXCEL</a>
                </div>
                <div class="form-group">
                  <label for="customFile">Unggah file excel</label>
                  <div class="custom-file">
                    <input class="custom-file-input" type="file" name="foto" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="customFile" >
                    <label class="custom-file-label" for="customFile">Pilih file</label>
                  </div>
                </div>
                <div class="form-group" style="text-align:center;">
                  <input type="submit" class="btn btn-success" value="Unggah">
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    @endsection
    @section('javascript')
    <!-- jquery-validation -->
    <script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Select2 -->
    <script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Page specific script -->
    <script>
      $(function () {
        bsCustomFileInput.init();
         //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

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
            },
            telp: {
              maxlength: 20,
            }
          },
          messages: {
            nis: {
              required: "NIS harus diisi",
              number: "Mohon isi NIS dengan benar",
            },
            nama: {
              required: "Nama lengkap harus diisi",
            },
            tgl_lahir: {
              required: "Tanggal lahir harus diisi",
              date: "Mohon isi tanggal dengan benar",
            },
            kd_kelas: {
              required: "Kelas harus diisi",
            },
            telp: {
              maxlength: "Nomor telepon terlalu panjang!",
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
