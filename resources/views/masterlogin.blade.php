<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-PKL | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/AdminLTE-master/dist/css/adminlte.min.css">
  <style>
  .gradient-custom {
    /* fallback for old browsers */
    background: #a18cd1;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(45deg,
      rgba(29, 236, 197, 0.6),
      rgba(91, 14, 214, 0.6) 100%);

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(45deg,
      rgba(29, 236, 197, 0.6),
      rgba(91, 14, 214, 0.6) 100%);
  }
  a, a:hover{
  color:#666
  }
</style>
</head>
<body>
  <div class="bg-image" style="
  background-image: url('data_file/wp3222138.jpg');
  background-size: cover;
  height: 100vh;
  ">
  <div class="mask gradient-custom" style="height:100vh;">
    <div class="d-flex justify-content-center align-items-center">
      <img src="data_file/smk-n-1-pengasih-seeklogo.png" style="height:122px;margin-top:5vh;">
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <h2 class="text-center text-white" style="margin-top: 2vh;margin-bottom: 4vh;"> Selamat Datang di<br>
        Sistem Informasi Praktik Kerja Lapangan<br>
        <a target="_blank" rel="noopener noreferrer" href="http://v5.smkn1pengasih.sch.id/" style="color: white;"><b>SMK Negeri 1 Pengasih</b></a></h2>
    </div>
      <div class="d-flex justify-content-center align-items-center">
        @yield('content')
      </div>
      <div class="d-flex justify-content-center align-items-center">

      </div>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('/')}}/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/AdminLTE-master/dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>
</body>
</html>