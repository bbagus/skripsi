@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
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
@section('content')
<div class="col-10 offset-md-1">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Daftar Pedoman PKL</h3>
      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" id="myInput" class="form-control float-right" placeholder="Cari">
        </div>
      </div>
    </div>

    <div class="card-body table-responsive p-0">
     <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>File</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <tr>
          <td>1</td>
          <td>Pedoman PKL SMK 2017</td>
          <td> Pedoman pengelolaan Praktik Kerja Lapangan untuk Sekolah Menengah Kejuruan (DIREKTORAT  PEMBINAAN  SEKOLAH MENENGAH KEJURUAN)</td>
          <td><a href="{{url('/')}}/data_file/Pedoman-PKL-SMK-2017.doc"><i class="fas fa-download"></i></a></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Panduan menggunakan Si-PKL</td>
          <td> Buku panduan langkah-langkah menggunakan sistem informasi praktik kerja lapangan</td>
          <td><a href="#"><i class="fas fa-download"></i></a></td>
        </tr>
         <tr>
          <td>3</td>
          <td>Alur pelaksanaan PKL</td>
          <td> infografik alur pelaksanaan PKL SMK Negeri 1 Pengasih 2022</td>
          <td><a href="#"><i class="fas fa-download"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    </div>
</div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection