@extends('layout.master')
@section('title')
SI-PKL : Admin - Detail pengajuan 
@endsection
@section('head')

@endsection
@section('sidebar')
  @include('layout.sidebaradmin')
@endsection
@section('judul', 'Detail Pengajuan')
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
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <a href="/admin/kelola-pengajuan"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
          </h3>
        </div>
        <div class="card-body box-profile">
          <div class="text-center mb-3">
            @if ($siswa->foto != 'default.jpg')
            <img class="img-fluid"
            src="{{url('/')}}/data_file/{{$siswa->foto}}"
            alt="User profile picture" style="min-height:140px;">
            @else
            <img class="img-fluid"
            src="{{url('/')}}/data_file/siswa-default.jpg"
            alt="User profile picture" style="min-height:140px;">
            @endif
          </div>
          <table class="table table-hover table-striped">
            <tbody>
              <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{$siswa->nama}} </td>
              </tr>
              <tr>
                <td>Instansi yang Diajukan</td>
                <td>:</td>
                <td>{{$industri->nama??'-'}}</td>
              </tr>
              <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td>{{$pengajuan->tgl_pengajuan}}</td>
              </tr>
              <tr>
                <td>Tanggal Diproses</td>
                <td>:</td>
                <td>{{$pengajuan->tgl_diproses}}</td>
              </tr>
              <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{$tahunajaran}}</td>
              </tr>
            </tbody>
          </table>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item text-center mr-4">
              @if($pengajuan->status == 'Menunggu')
              <form method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="{{$pengajuan->kd_pengajuan}}" name="kd">
                <button type="submit" formaction="{{route('terima')}}" class="btn btn-small btn-success mr-4"><i class="fas fa-check"></i> Terima</button>
                <button type="submit"  formaction="{{route('tolak')}}" class="btn btn-small btn-danger ml-4"><i class="fas fa-times"></i> Tolak</button>
              </form>
              @elseif($pengajuan->status == 'Diterima')
              <button class="btn btn-small btn-success mr-4"><i class="fas fa-check"></i> Diterima</button>
              @else
              <button class="btn btn-small btn-danger mr-4"><i class="fas fa-times"></i> Ditolak</button>
              @endif
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
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Detail Instansi</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content mb-3">
            <div class=" <?php echo count($errors) > 0 ? '': 'active' ?> tab-pane" id="activity">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                 <tbody>
                  <tr>
                    <td class="col-sm-3">Nama Lengkap</td>
                    <td>:</td>
                    <td>{{$siswa->nama}} </td>
                  </tr>
                  <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>{{$siswa->nis}}</td>
                  </tr>
                  <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>{{$siswa->kelas}}</td>
                  </tr>
                  <tr>
                    <td>Jurusan</td>
                    <td>:</td>
                    <td>{{$siswa->jurusan}}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{$siswa->tgl_lahir}}</td>
                  </tr>
                  <tr>
                    <td>No. Telp</td>
                    <td>:</td>
                    <td>{{$siswa->telp}}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="max-width:850px;">{{$siswa->alamat}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="<?php echo count($errors) > 0 ? 'active': '' ?> tab-pane" id="settings">
           <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
             <tbody>
              @if($industri != null)
              <tr>
                <td class="col-sm-3">Nama Instansi</td>
                <td>:</td>
                <td>{{$industri->nama}} </td>
              </tr>
              <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>{{$industri->jurusan}}</td>
              </tr>
              <tr>
                <td>Bidang Kerja</td>
                <td>:</td>
                <td>{{$industri->bidang_kerja}}</td>
              </tr>
              <tr>
                <td>Deskripsi Instansi</td>
                <td>:</td>
                <td style="max-width:850px;">{{$industri->deskripsi}}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td style="max-width:850px;">{{$industri->alamat}}</td>
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
              @else
              <tr>
                <td>Belum mengajukan instansi</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div><!-- /.card-body -->
</div>
@if($industri != null)
<div class="card card-orange">
  <div class="card-header">
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
    <h3 class="card-title text-white">
     Kuota
   </h3>
 </div>
 <div class="card-body" style="padding: 1.75rem 1.75rem;">
  <p class="text-justify">
   {{$industri->nama}} masih bisa menerima &nbsp; : &nbsp; {{$industri->kuota - $count}} siswa.
 </p>
</div>
<!-- /.card -->
</div>
@endif
<!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('modal')

@endsection
@section('javascript')
@endsection