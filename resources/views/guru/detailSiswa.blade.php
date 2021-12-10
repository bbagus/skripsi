@extends('layout.master')
@section('title')
SI-PKL : Guru - Detail Siswa & Instansi
@endsection
@section('head')
@endsection
@section('sidebar')
  @include('layout.sidebarguru')
@endsection
@section('judul', 'Detail Siswa & Instansi')
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
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <a href="javascript:void(0)" onclick="goBack()"><i class="fas fa-arrow-left"></i>&nbsp; Kembali</a>
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
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{$tahunajaran}}</td>
              </tr>
            </tbody>
          </table>
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
             <li class="nav-item"><a class="nav-link" href="#jadwal" data-toggle="tab">Jadwal PKL</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content mb-3">
            <div class="active tab-pane" id="activity">
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
                    <td>Program Keahlian</td>
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
                   <tr>
                      <td>Nama Orang Tua/Wali</td>
                      <td>:</td>
                      <td>{{$siswa->orang_tua}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="settings">
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
                <td>Bagian/Divisi</td>
                <td>:</td>
                <td>{{$detail!=null?$detail->bagian:''}}</td>
              </tr>
              <tr>
                <td>Nama Pimpinan</td>
                <td>:</td>
                <td>{{$detail!=null?$detail->pimpinan:''}}</td>
              </tr>
              <tr>
                <td>Nama Pembimbing</td>
                <td>:</td>
                <td>{{$detail!=null?$detail->pembimbing:''}}</td>
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
      <div class="tab-pane" id="jadwal">
        <div class="form-group row">
          <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
          <div class="col-sm-2 input-group date">
            <input type="date" disabled class="form-control datetimepicker-input" name="tgl_mulai" value="{{$penempatan->tgl_mulai}}"/>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
          <div class="col-sm-2 input-group date">
            <input type="date" disabled class="form-control" name="tgl_selesai" value="{{$penempatan->tgl_selesai}}">
          </div>
        </div>
        <table class="table table-bordered table-striped mt-4">
         @if($industri!=null)
          <thead>
            <tr>
              <th>Hari</th>
              <th>Jam Masuk Pagi</th>
              <th>Jam Masuk Siang</th>
              <th>Jam Istirahat</th>
              <th>Jam Pulang Sore</th>
              <th>Jam Pulang Malam</th>
            </tr>
          </thead>
          <tbody style="text-align: center;">
            <tr>
              <td>Senin</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->senin[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Selasa</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->selasa[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Rabu</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->rabu[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Kamis</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->kamis[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Jumat</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->jumat[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Sabtu</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->sabtu[$i]:''}}</td>
              @endfor
            </tr>
            <tr>
              <td>Minggu</td>
              @for($i = 0; $i < 5; $i++)
              <td>{{$jadwal!=null?$jadwal->minggu[$i]:''}}</td>
              @endfor
            </tr>
          </tbody>
           @else
            <tr>
              <td>Belum mengajukan instansi</td>
            </tr>
            @endif
        </table>
      </div>
    </div>
    <!-- /.tab-content -->
  </div><!-- /.card-body -->
</div>
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
<script defer>
function fadeOut(){
  $('#sukses').hide();
}
function goBack() {
  window.history.back();
  if(history.length < 2){
    window.close();
  }
};
</script>
@endsection