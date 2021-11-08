@extends('layout.master')
@section('title')
SI-PKL : Ubah Data Siswa - {{$siswa->nama}}
@endsection
@section('head')
<!-- Select2 -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('sidebar')
@include('layout.sidebaradmin')
@endsection
@section('judul', 'Mengubah Data Siswa')
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
        <form class="form-horizontal" id="formsiswa" action="{{route('proses_edit')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="nislama" value="{{$siswa->nis}}" />

          <div class="card-body" style="padding: 1.75rem 3rem;">
            <div class="form-group row">
              <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Siswa<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Tulis nomor induk siswa.." value="{{$siswa->nis}}" maxlength="15">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama Lengkap.." value="{{$siswa->nama}}" maxlength="50">
              </div>
            </div>
            <div class="form-group row">
              <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<strong class="text-danger">*</strong></label>
              <div class="col-sm-10 input-group date">
                <input type="date" class="form-control datetimepicker-input" name="tgl_lahir" value="{{$siswa->tgl_lahir}}"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="kd_kelas" class="col-sm-2 col-form-label" class="col-sm-2 col-form-label">Kelas<strong class="text-danger">*</strong></label>
              <div class="col-sm-10">
                <select class="form-control select2bs4" name="kd_kelas" style="width: 100%;">
                  <option <?php echo $siswa->kd_kelas == '1' ? 'selected': '' ?> value="1">XI MM 1</option>
                  <option <?php echo $siswa->kd_kelas == '2' ? 'selected': '' ?> value="2">XI MM 2</option>
                  <option <?php echo $siswa->kd_kelas == '3' ? 'selected': '' ?> value="1">XI MM 3</option>
                  <option <?php echo $siswa->kd_kelas == '4' ? 'selected': '' ?> value="2">XI AKL 1</option>
                  <option <?php echo $siswa->kd_kelas == '5' ? 'selected': '' ?> value="1">XI AKL 2</option>
                  <option <?php echo $siswa->kd_kelas == '6' ? 'selected': '' ?> value="2">XI OTKP 1</option>
                  <option <?php echo $siswa->kd_kelas == '7' ? 'selected': '' ?> value="1">XI OTKP 2</option>
                  <option <?php echo $siswa->kd_kelas == '8' ? 'selected': '' ?> value="2">XI BDP 1</option>
                  <option <?php echo $siswa->kd_kelas == '9' ? 'selected': '' ?> value="1">XI BDP 2</option>
                  <option <?php echo $siswa->kd_kelas == '10' ? 'selected': '' ?> value="2">XI TB</option>
                  <option <?php echo $siswa->kd_kelas == '11' ? 'selected': '' ?> value="1">XI PH</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="telp" class="col-sm-2 col-form-label">No. Telepon</label>
              <div class="col-sm-10">
                <input type="text" name="telp" class="form-control" id="telp" placeholder="Tulis nomor telepon.." value="{{$siswa->telp}}" maxlength="20" >
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea type="text" name="alamat" class="form-control" id="telp" placeholder="Tulis alamat lengkap.."s>{{$siswa->alamat}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="foto" class="col-sm-2 col-form-label">Foto Profil</label>
              <div class="col-sm-10">
                @if($siswa->foto != 'default.jpg')
                <img class="img-fluid mb-3" style="width: 150px;float:left;" src="{{url('/')}}/data_file/{{$siswa->foto}}" alt="">
                <a class="close" title="hapus foto(jangan lupa klik simpan)" style="float: left;
                margin-left: 5px;" href="{{url('/')}}/admin/kelola-siswa/hapus-foto/{{$siswa->nis}}">x</a>
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
            Akun
          </h3>
        </div>
        <div class="card-body" style="padding: 1rem 2rem;">
          <p class="text-justify">
            <div class="row">
              <div class="col-4">Username</div>
              <div class="col-1">:</div>
              <div class="col-6">{{$siswa->username}} (NIS)</div>
              <div class="col-4">Email</div>
              <div class="col-1">:</div>
              <div class="col-6">{{$siswa->email}}
              </div>
              <div class="col-4">Password</div>
              <div class="col-1">:</div>
              <div class="col-6">
                <a onclick="resetConfirm()" href="#">Reset password</a></div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('modal')
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:150px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Password akan kembali ke setelan awal (Tanggal lahir siswa).</div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="{{url('/')}}/admin/kelola-siswa/reset-password/{{$siswa->nis}}">Reset</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<!-- jquery-validation -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url('/')}}/AdminLTE-master/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script defer>
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
  function resetConfirm(){
  $('#resetModal').modal();
  }
</script>
@endsection
