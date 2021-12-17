@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
@endsection
@section('head')
@endsection
@section('sidebar')
<!-- Main Sidebar Container -->
@auth
  @if (Auth::user()->role == 'admin')
    @include('layout.sidebaradmin')
  @elseif (Auth::user()->role == 'siswa')
    @include('layout.sidebarsiswa')
  @elseif (Auth::user()->role == 'guru')
    @include('layout.sidebarguru')
  @endif
@endauth
@endsection
  @section('judul', 'Detail Industri')
  @section('content')
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <a onclick="goBack()" href="#"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
              </h3>
            </div>
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($industri->foto != 'default.jpg')
                <img class="img-fluid"
                src="{{url('/')}}/data_file/{{$industri->foto}}"
                alt="Logo Industri" style="min-height:150px;">
                @else
                <img class="img-fluid"
                src="{{url('/')}}/data_file/industri-default.webp"
                alt="Logo Industri" style="min-height:150px;">
                @endif
              </div>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item"> 
                  
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
             <h3 class="card-title">
                <h3 class="card-title">
                Detail Industri
              </h3>
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content mb-3">
                <div class=" <?php echo count($errors) > 0 ? '': 'active' ?> tab-pane" id="activity">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="col-sm-3">Nama Instansi</td>
                          <td>:</td>
                          <td>{{$industri->nama}} </td>
                        </tr>
                        <tr>
                          <td>Bidang Kerja</td>
                          <td>:</td>
                          <td>{{$industri->bidang_kerja}}</td>
                        </tr>
                        <tr>
                          <td>Deskripsi Instansi</td>
                          <td>:</td>
                          <td>{{$industri->deskripsi}}</td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td>:</td>
                          <td>{{$industri->alamat}}</td>
                        </tr>
                        <tr>
                          <td>Nama Kontak</td>
                          <td>:</td>
                          <td>{{$industri->nama_kontak}}</td>
                        </tr>
                        <tr>
                          <td>No. Telp</td>
                          <td>:</td>
                          <td>{{$industri->telp}}</td>
                        </tr>
                       <tr>
                          <td>Website</td>
                          <td>:</td>
                          <td>{{$industri->website}}</td>
                        </tr>
                        <tr>
                          <td>email</td>
                          <td>:</td>
                          <td>{{$industri->email}}</td>
                        </tr>
                         <tr>
                          <td>Kuota yang disediakan</td>
                          <td>:</td>
                          <td>{{$industri->kuota}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
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
@section('javascript')
<script>
function goBack() {
  window.history.back();
}
</script>
 @endsection