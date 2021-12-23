@extends('layout.master')
@section('title', 'SI-PKL : Siswa - Nilai')
@section('sidebar')
  @include('layout.sidebarsiswa')
@endsection
@section('judul', 'Lihat Nilai')
@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <!-- alert error-->
           <div id="sukses" class="alert alert-dismissible shadow" style="display:none;">
            <button type="button" class="close" onclick="fadeOut()">×</button>
            <div id="pesan">
            </div>
          </div>
          <div class="card">
              <div class="card-header" style="background-color: #094688;">
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
                 <h3 class="card-title text-white">
                Nilai PKL
                </h3>
              </div>
              <div class="card-body m-3">
                 @if($penempatan!=null)
                <div class="form-group row">
                  <label for="nilai_sikap" class="col-sm-2 col-form-label">Nilai Sikap</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="nilai_sikap" placeholder="Nilai sikap.." disabled maxlength="3" value="{{$nilai!=null?$nilai->nilai_sikap:''}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nilai_pengetahuan" class="col-sm-2 col-form-label">Nilai Pengetahuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="nilai_pengetahuan" placeholder="Nilai pengetahuan.." disabled maxlength="3" value="{{$nilai!=null?$nilai->nilai_pengetahuan:''}}">
                  </div>
                </div><div class="form-group row">
                  <label for="nilai_keterampilan" class="col-sm-2 col-form-label">Nilai Keterampilan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="nilai_keterampilan" placeholder="Nilai keterampilan.." disabled maxlength="3" value="{{$nilai!=null?$nilai->nilai_keterampilan:''}}">
                  </div>
                </div>
                @else
                <div class="alert alert-danger">
                Pengajuan Anda belum diterima
                </div>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
@endsection