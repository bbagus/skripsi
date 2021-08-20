@extends('layout.master')
@section('title', 'SI-PKL : Ubah Pengumuman')
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- summernote -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/summernote/summernote-bs4.min.css">
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-dark">
    <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Informasi PKL</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{url('/')}}/data_file/15267-202005.jpg" class="img-circle elevation-2" alt="User Image">
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
            <a href="/admin/kelola-informasi" class="nav-link active">
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
                <a href="/admin/kelola-laporan-mingguan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    laporan mingguan
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
    @section('judul', 'Mengubah Pengumuman')
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
            <!-- /.card -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                   <a href="/admin/kelola-informasi"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
                </h3>
              </div>
              <!-- /.card-header -->
               <!-- form start -->
              <form id="forminfo" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                 <input type="hidden" name="kd_info" value="{{$info->kd_info}}" />
              <div class="card-body" style="padding: 1.75rem 2rem;">
                <div class="form-group mb-3">
                  <label for="judul">Judul pengumuman<strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" name="judul" placeholder="Tulis judul.." value="{{$info->judul}}">
                </div>
                <div class="form-group mb-3 col-sm-5">
                  <label for="status">Status<strong class="text-danger">*</strong></label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                        <option  <?php echo $info->status == 'Diumumkan' ? 'selected': '' ?> value="Diumumkan">Diumumkan</option>
                        <option <?php echo $info->status == 'Draf' ? 'selected': '' ?> value="Draf">Draf</option>
                        <option <?php echo $info->status == 'Disimpan' ? 'selected': '' ?> value="Disimpan">Disimpan</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                  <label for="isi">isi pengumuman<strong class="text-danger">*</strong></label>
                  <textarea id="compose-textarea" name="isi" class="form-control" style="height: 300px">{{$info->deskripsi}}</textarea>
                </div>
                <div class="form-group mb-3 col-sm-5">
                  <label for="kd_label">Label</label>
                  <select class="form-control select2bs4" name="kd_label" style="width: 100%;">
                        <option <?php echo $info->kd_label == '1' ? 'selected': '' ?> value="1">Pengajuan</option>
                        <option <?php echo $info->kd_label == '2' ? 'selected': '' ?> value="2">Laporan</option>
                        <option <?php echo $info->kd_label == '3' ? 'selected': '' ?> value="3">Tips</option>
                        <option <?php echo $info->kd_label == '4' ? 'selected': '' ?> value="4">Lain-lain</option>
                    </select>
                </div>
                <div class="form-group mb-3 col-sm-5">
                  <label for="penulis">Penulis</label>
                  <input type="text" class="form-control" name="penulis" value="{{$info->penulis}}" placeholder="Tulis nama penulis..">
                </div>
                <div class="form-group mb-3 col-sm-5">
                  <label for="foto">Thumbnail</label>
                  @if($info->foto != 'default.jpg')
                    <a class="close" title="hapus foto(jangan lupa klik simpan)" style="margin-left: 5px;float:right;" href="{{url('/')}}/admin/kelola-informasi/hapus-foto/{{$info->kd_info}}">x</a>
                    <img class="img-fluid mb-3" style="width: 150px;float:right;" src="{{url('/')}}/data_file/{{$info->foto}}" alt="">
                    @else
                       <input type="hidden" name="hapus" value="hapus" />
                    @endif
                  <div class="custom-file">
                      <input class="custom-file-input" type="file" name="foto" accept="image/png, image/jpeg" id="customFile" >
                     <label class="custom-file-label" for="customFile">Pilih file</label>
                      <font color="red">
                        Ukuran file maksimal 700 KB.<br>
                        Format file : jpg, jpeg, png.
                      </font>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success" formaction="{{route('edit_info')}}">Simpan</button>&nbsp;
                <input type="button" onclick="myFunction()" class="btn btn-default" value="Reset">
              </div>
              <!-- /.card-footer -->
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
    <!-- Summernote -->
<script src="{{url('/')}}/AdminLTE-master/plugins/summernote/summernote-bs4.min.js"></script>
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
    //Add text editor
      $('#compose-textarea').summernote({
        minHeight: 400,
        });
       $.validator.setDefaults({});
       $('#forminfo').validate({
          rules: {
            judul: {
              required: true,
            },
            isi: {
              required: true,
            }
          },
          messages: {
            judul: {
              required: "Judul harus diisi",
            },
            isi: {
              required: "informasi harus diisi",
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
        document.getElementById("forminfo").reset();
      }
    </script>
    @endsection
