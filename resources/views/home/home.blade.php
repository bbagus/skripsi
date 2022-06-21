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
                <div class="thumbnail" style="background-image:url(assets/images/1.jpg);">
                </div>
                </a>
              </div>
              <div class="col-md-7">
                <div class="card-block">
                  <h2 class="card-title"><a href="single.html">We all wait for summer</a></h2>
                  <h4 class="card-text">This is changed. As I engage in the so-called “bull sessions” around and about the school, I too often find that most college men have...</h4>
                  <div class="metafooter">
                                        <div class="wrapfooter">
                      <span class="meta-footer-thumb">
                      <img class="author-thumb" src="https://www.gravatar.com/avatar/b1cc14991db7a456fcd761680bbc8f81?s=250&d=mm&r=x" alt="John">
                      </span>
                      <span class="author-meta">
                      <span class="post-name"><a target="_blank" href="#">John</a></span><br/>
                      <span class="post-date">12 Jan 2018</span>
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
                <div class="thumbnail" style="background-image:url(assets/images/4.jpg);">
                </div>
                </a>
              </div>
              <div class="col-md-7">
                <div class="card-block">
                  <h2 class="card-title"><a href="single.html">Powerful things you can do with the Markdown editor</a></h2>
                  <h4 class="card-text">There are lots of powerful things you can do with the Markdown editor </h4>
                  <div class="metafooter">
                    <div class="wrapfooter">
                      <span class="meta-footer-thumb">
                      <img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&d=mm&r=x" alt="Sal">
                      </span>
                      <span class="author-meta">
                      <span class="post-name"><a target="_blank" href="#">Sal</a></span><br/>
                      <span class="post-date">12 Jan 2018</span>
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
                <h2 class="card-title"><a href="single.html">Tree of Codes</a></h2>
                <h4 class="card-text">The first mass-produced book to deviate from a rectilinear format, at least in the United States, is thought to be this 1863 edition of Red Riding Hood, cut into the...</h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&d=mm&r=x" alt="Sal">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Sal</a></span><br/>
                    <span class="post-date">12 Jan 2018</span>
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
                <h2 class="card-title"><a href="single.html">Red Riding Hood</a></h2>
                <h4 class="card-text">The first mass-produced book to deviate from a rectilinear format, at least in the United States, is thought to be this 1863 edition of Red Riding Hood, cut into the...</h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&d=mm&r=x" alt="Sal">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Sal</a></span><br/>
                    <span class="post-date">12 Jan 2018</span>
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
              <img class="img-fluid" src="assets/images/5.jpg" alt="Is Intelligence Enough">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Is Intelligence Enough</a></h2>
                <h4 class="card-text">Education must also train one for quick, resolute and effective thinking. To think incisively and to think for one’s self is very difficult. </h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&d=mm&r=x" alt="Sal">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">Sal</a></span><br/>
                    <span class="post-date">12 Jan 2018</span>
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
              <img class="img-fluid" src="assets/images/6.jpg" alt="Markdown Example">
              </a>
              <div class="card-block">
                <h2 class="card-title"><a href="single.html">Markdown Example</a></h2>
                <h4 class="card-text">You’ll find this post in your _posts directory. Go ahead and edit it and re-build the site to see your changes. You can rebuild the site in many different ways,...</h4>
                <div class="metafooter">
                  <div class="wrapfooter">
                    <span class="meta-footer-thumb">
                    <img class="author-thumb" src="https://www.gravatar.com/avatar/b1cc14991db7a456fcd761680bbc8f81?s=250&d=mm&r=x" alt="John">
                    </span>
                    <span class="author-meta">
                    <span class="post-name"><a target="_blank" href="#">John</a></span><br/>
                    <span class="post-date">11 Jan 2018</span>
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