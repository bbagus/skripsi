<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
  @yield('head')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/dist/css/adminlte.min.css">
</head>
@guest
<body class="hold-transition layout-top-nav">
  @else
  <body class="hold-transition sidebar-mini ">
    @endguest
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- navbar -->
    @auth
      <nav class="main-header navbar navbar-expand-md navbar-navy navbar-dark border-bottom-0" style="background-color: #094688;"> 
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">   
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>          
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="/industri" class="nav-link">Industri</a>
          </li>
          <li class="nav-item">
            <a href="/pedoman" class="nav-link">Pedoman PKL</a>
          </li>
        </ul>
      </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Cari.." aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
          <!-- Messages Dropdown Menu -->       
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
             <i class="far fa-comments"></i>
             <span class="badge badge-danger navbar-badge">3</span>
           </a>
           <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
               <img src="{{url('/')}}/AdminLTE-master/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
               <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{url('/')}}/AdminLTE-master/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{url('/')}}/AdminLTE-master/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('signout') }}">
          <i class="fas fa-sign-out-alt"></i>&nbsp;log-out
        </a>
      </li>
    </ul>
  </nav>
  @endauth
  @guest
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark">
    <div class="container" style="max-width:1550px;">
      <ul class="navbar-nav">            
        <li class="nav-item">
      <a href="{{url('/')}}" class="navbar-brand">
      <img src="{{url('/')}}/data_file/smk-n-1-pengasih-seeklogo.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="height:60px;">
      </a>
        </li>
        <li class="nav-item">
      <span class="brand-text" style="font-size: 1.2rem;">Sistem Informasi Praktik Kerja Lapangan</span>
      <br>
      <span class="brand-text" style="font-size: 1.3rem;">SMK Negeri 1 Pengasih</span>
        </li>
      </ul>
    </div>
  </nav>
  <nav class="main-header navbar navbar-expand-md navbar-navy navbar-dark" style="background-color: #094688;">
  <div class="container" style="max-width:1550px;">
     <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
        <ul class="navbar-nav">            
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="/industri" class="nav-link">Industri</a>
          </li>
          <li class="nav-item">
            <a href="/pedoman" class="nav-link">Pedoman PKL</a>
          </li>
        </ul>
       <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Cari" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
       <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-sign-out-alt"></i>&nbsp;Login</a>
        </li>
      </ul>
    </div>
  </nav>
  @endguest
  <!-- /.navbar -->
  <!-- sidebar -->
  @yield('sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">@yield('judul')</h3>
          </div>
          <div class="col-sm-6">
           @if (\Request::is('/'))  
           @else
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="/">Home</a></li>         
             <?php $link = "" ?>
             @for($i = 1; $i <= count(Request::segments()); $i++)
             @if($i < count(Request::segments()) & $i > 0)
             <?php $link .= "/" . Request::segment($i); ?>
             <li class="breadcrumb-item active"><a href="<?= $link ?>">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
             @else 
             <li class="breadcrumb-item"> {{ucwords(str_replace('-',' ',Request::segment($i)))}}</li>
             @endif
             @endfor
           </ol>
           @endif
         </div>

       </div>
     </div><!-- /.container-fluid -->
   </section>

   @yield('content')
 </div>
 <!-- /.content-wrapper -->

 <footer class="main-footer" style="text-align: center;">
  <strong>
    SI-PKL 2021.
  </strong>
</footer>
</div>
<!-- ./wrapper -->
@yield('modal')
<!-- jQuery -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/AdminLTE-master/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/AdminLTE-master/dist/js/demo.js"></script>
<script src="{{url('/')}}/AdminLTE-master/dist/js/pages/dashboard3.js"></script>
@yield('javascript')
</body>
</html>
