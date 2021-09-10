@extends('layout.master')
@section('title', 'SI-PKL : Tambah Data Industri')
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
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="logo SMK N 1 Pengasih" class="brand-image img-circle elevation-3" style="opacity: .8">
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
          <li class="nav-item">
            <a href="/admin/kelola-informasi" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/kelola-siswa" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/kelola-guru" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru Pembimbing</p>
                </a>
              </li>
            </ul>
          </li>  
          <li class="nav-item">
            <a href="/admin/kelola-industri" class="nav-link active">
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
    @section('judul', 'Menambah Data Industri')
    @section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
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
            <div class="card card-info" >
              <div class="card-header">
                <h3 class="card-title">
                  <a href="/admin/kelola-industri"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="formindustri" action="{{route('upload_industri')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body " style="padding: 1.75rem 5rem;">
                  <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama industri.." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <select class="form-control select2bs4" name="jurusan" style="width: 100%;">
                        <option disabled="" selected="" hidden="">Pilih Jurusan</option>
                        <option value="Akuntansi Keuangan dan Lembaga">Akuntansi Keuangan dan Lembaga</option>
                        <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                        <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                        <option value="Perhotelan">Perhotelan</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Tata Busana">Tata Busana</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bidang_kerja" class="col-sm-2 col-form-label">Bidang kerja<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="bidang_kerja" placeholder="Tulis bidang kerja.." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                      <textarea type="text" name="deskripsi" class="form-control" placeholder="Tulis deskripsi.."s></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat<strong class="text-danger">*</strong></label>
                    <div class="col-sm-9">
                      <textarea type="text" name="alamat" class="form-control" placeholder="Tulis alamat lengkap.."s></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="wilayah" class="col-sm-2 col-form-label">Wilayah<strong class="text-danger">*</strong></label>
                    <div class="col-sm-3">
                      <input type="text" name="wilayah" class="form-control" placeholder="Tulis wilayah/kota.." maxlength="50">
                    </div>
                    <div class="col-sm-1"></div>
                    <label for="website" class="col-sm-1 col-form-label">Website</label>
                    <div class="col-sm-4">
                      <input type="text" name="website" class="form-control"  placeholder="Tulis alamat website.." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-3">
                      <input type="text" name="telp" class="form-control" placeholder="Tulis nomor telepon.." maxlength="20">
                    </div>
                    <div class="col-sm-1"></div>
                    <label for="nama_kontak" class="col-sm-1 col-form-label">Nama kontak</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_kontak" class="form-control"  placeholder="Tulis nama kontak.." maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                      <input type="email" name="email" class="form-control"  placeholder="Tulis alamat email.." maxlength="50">
                    </div>
                     <div class="col-sm-1"></div>
                    <label for="kuota" class="col-sm-1 col-form-label">Kuota<strong class="text-danger">*</strong></label>
                    <div class="col-sm-4">
                      <input type="text" name="kuota" class="form-control"  placeholder="Tulis kuota.." maxlength="10">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Logo Industri</label>
                    <div class="col-sm-9">
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
        $('#formindustri').validate({
          rules: {
            nama: {
              required: true,
            },
            jurusan: {
              required: true,
            },
            bidang_kerja: {
              required: true,
            },
            alamat: {
              required: true,
            },
            wilayah: {
              required: true,
            },
            email: {
              email: true,
            },
            kuota: {
              required: true,
              number: true,
            }
          },
          messages: {
            nama: {
              required: "Nama harus diisi",
            },
            bidang_kerja: {
              required: "Bidang kerja harus diisi",
            },
            jurusan: {
              required: "Jurusan harus diisi",
            },
            alamat: {
              required: "Alamat harus diisi",
            },
            wilayah: {
              required: "Wilayah harus diisi",
            },
            email: {
              email: "Isi email dengan benar",
            },
            kuota: {
              required: "Kuota harus diisi",
              number: "Mohon isi kuota dengan angka",
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
        document.getElementById("formindustri").reset();
      }
    </script>
    @endsection
