@extends('layout.master')
@section('title', 'Sistem Informasi PKL SMK Negeri 1 Pengasih')
@section('navbar')
@endsection
@section('sidebar')
@section('head')
<link href="{{url('/')}}/assets/css/theme.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
@endsection
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
<div class="site-content" style="padding-top:0rem;">
  <section class="intro">

  </section>
<!-- Container
    ================================================== -->
  <div class="container">
    <div class="main-content">
      <!-- Featured
            ================================================== -->
      <section class="featured-posts">
<!--       <div class="section-title">
        <h2><span>Featured</span></h2>
      </div> -->
      <div class="row listfeaturedtag">
        <!-- begin post -->
        <div class="col-sm-6">
          <div class="card">
            <div class="row">
              <div class="col-md-5 wrapthumbnail">
                <a href="single.html">
                <div class="thumbnail" style="background-image:url(assets/images/2.jpg);">
                </div>
                </a>
              </div>
              <div class="col-md-7">
                <div class="card-block">
                  <h2 class="card-title"><a href="single.html">Pengumuman Pelaksanaan PKL 2022/2023</a></h2>
                  <h4 class="card-text">... <a href="">baca</a></h4>
                  <div class="metafooter">
                                        <div class="wrapfooter">
                      <span class="meta-footer-thumb">
                      <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                      <span class="author-meta">
                      <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                      <span class="post-date">12 Jan 2022</span>
                      </span>
                      <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                      <div class="clearfix">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end post -->
        <!-- begin post -->
        <div class="col-sm-6">
          <div class="card">
            <div class="row">
              <div class="col-md-5 wrapthumbnail">
                <a href="single.html">
                <div class="thumbnail" style="background-image:url(assets/images/3.jpg);">
                </div>
                </a>
              </div>
              <div class="col-md-7">
                <div class="card-block">
                  <h2 class="card-title"><a href="single.html">Alur Proses Pengajuan tempat PKL</a></h2>
                  <h4 class="card-text">Berikut alur/timeline proses pengajuan PKL mulai dari awal mendapat akun Si-PKL sampai program PKL selesai ... <a href="">baca</a></h4>
                  <div class="metafooter">
                    <div class="wrapfooter">
                      <span class="meta-footer-thumb">
                      <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                      </span>
                      <span class="author-meta">
                      <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                      <span class="post-date">01 Jan 2022</span>
                      </span>
                      <span class="post-read-more"><a href="single.html" title="Baca pengumuman"><i class="fa fa-link"></i></a></span>
                      <div class="clearfix">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end post -->
      </div>
      </section>
      <!-- Posts Index
        ================================================== -->
      <section class="recent-posts row">
      <div class="col-sm-4">
        <div class="sidebar">
          <div class="sidebar-section">
            <h5><span>Kategori</span></h5>
            <ul style="list-none;" class="nav nav-pills">
              <li><a target="_blank" class="nav-link" href="#">Pengajuan</a></li>
              <li><a target="_blank" class="nav-link" href="#">Laporan</a></li>
              <li><a target="_blank" class="nav-link" href="#">Tips</a></li>
              <li><a target="_blank" class="nav-link" href="#">Lain-lain</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="section-title">
          <h2><span>Informasi</span></h2>
        </div>
        <div class="masonrygrid row listrecent">
          <!-- begin post -->
          <div class="col-md-6 grid-item">
            <div class="card">
              <a href="single.html">
              <img class="img-fluid" src="assets/images/2.jpg" alt="Tree of Codes">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Pengumuman Pelaksanaan PKL 2022/2023</a></h2>
                <h4 class="card-text"> ... <a href="">baca</a> </h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                    <span class="post-date">29 Des 2021</span>
                    </span>
                    <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                    <div class="clearfix">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end post -->
          <!-- begin post -->
          <div class="col-md-6 grid-item">
            <div class="card">
              <a href="single.html">
              <img class="img-fluid" src="assets/images/3.jpg" alt="Red Riding Hood">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Alur Proses Pengajuan tempat PKL</a></h2>
                <h4 class="card-text">Berikut alur/timeline proses pengajuan PKL mulai dari awal mendapat akun Si-PKL sampai program PKL selesai ... <a href="">baca</a></h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                   <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                    <span class="post-date">01 Jan 2022</span>
                    </span>
                    <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                    <div class="clearfix">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end post -->
          <!-- begin post -->
          <div class="col-md-6 grid-item">
            <div class="card">
              <a href="single.html">
              <img class="img-fluid" src="assets/images/1.jpg" alt="Is Intelligence Enough">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Bimbingan lebih mudah di Si-PKL</a></h2>
                <h4 class="card-text"> Saat ini siswa dan guru pembimbing dapat melakukan percakapan di menu bimbingan. Selain itu ... <a href="">baca</a></h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                   <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                    <span class="post-date">25 Des 2021</span>
                    </span>
                    <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                    <div class="clearfix">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end post -->
          <!-- begin post -->
          <div class="col-md-6 grid-item">
            <div class="card">
              <a href="single.html">
              <img class="img-fluid" src="assets/images/2.jpg" alt="Markdown Example">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Penambahan Fitur Post</a></h2>
                <h4 class="card-text">Si-PKL saat ini dapat menyampaikan informasi lewat halaman depan seperti blog. ... <a href="">baca</a></h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="{{url('/')}}/data_file/Admin-Administrator.jpg" alt="admin">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Admin</a></span><br/>
                    <span class="post-date">23 Des 2021</span>
                    </span>
                    <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                    <div class="clearfix">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end post -->
        </div>
        <!-- Pagination -->
        <div class="bottompagination">

        </div>
      </div>
      </section>
    </div>
  </div>
    <!-- /.container -->
</div>
@endsection
@section('javascript')
<script src="{{url('/')}}/assets/js/jquery.min.js"></script>
<script src="{{url('/')}}/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="{{url('/')}}/assets/js/masonry.pkgd.min.js"></script>
<script src="{{url('/')}}/assets/js/theme.js"></script>
@endsection