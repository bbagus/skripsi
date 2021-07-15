@extends('masterlogin')

@section('content')

                <div class="card card-dark">
                    <h3 class="card-header text-center">Login</h3>
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">
                         @if(session('success'))
                        {{session('success')}}
                        @else
                        Silahkan masuk menggunakan akun anda
                        @endif
                        </p>
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Username" id="username" class="form-control" name="username" required
                                    autofocus style="border-right-color: rgb(206, 212, 218);
border-right-style: solid;
border-right-width: 1px;">
                                    <!-- <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div> -->
                                @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                            </div>

                            <div class="input-group mb-3" id="show_hide_password">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="row">
                              <div class="col-8">
                                <div class="icheck-primary">
                                  <input type="checkbox" id="remember" name="remember">
                                  <label style="font-weight: 400;" for="remember">
                                    Ingat saya
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="d-grid mx-auto mb-2 mt-1">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                        </form>
                         <p class="mb-3 mt-1">
                         <a href="forgot-password.html">Lupa password ?</a> </p>
                    </div>
                    <div class="card-body login-card-body" style="padding-top: 0px;">
                        <p class="login-box-msg" style="padding-bottom: 0px;">
                            <b>SI-PKL 2021.</b>
                        </p>
                    </div>
                </div>
            </div>
@endsection