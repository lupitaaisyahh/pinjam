<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Informasi Peminjaman Saran Prasarana" />
    <meta name="author" content="Fakultas Matematika dan Ilmu Pengetahuan Alam" />

    <!-- Title -->
    <title>Sistem Informasi Peminjaman Saran Prasarana</title>

    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('public/img/logo.png') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ url('public/assetsnew/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['{!!url("public")!!}/assetsnew/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{!!url('public/assetsnew/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{{ url('public/assetsnew/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assetsnew/css/login.css') }}">
</head>

<body class="login">
    
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <!-- logo -->
            <div class="text-center mb-4"><img src="{{ url('public/img/logo.png') }}" alt="Logo" width="95px"></div>
            <!-- judul -->
            <h3 class="text-center mb-5">Sistem Informasi<br>Peminjaman Saran Prasarana <br> - Login Mahasiswa - </h3>
            <!-- form login -->
            <form action="{{ route('mahasiswa.logins') }}" method="post" class="needs-validation" novalidate>
                @csrf
                    @if($errors->has('email') || $errors->has('password'))
                    <div id="error">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> Username/Password Salah ! !
                        </div>
                    </div>
                    <br>
                    @endif
                    @if(Session::has('pesan'))
                    <div id="error">
                        <div class="alert alert-success">
                            <i class="fas fa-exclamation-circle"></i> Pendaftaran Berhasil, Silahkan Login !!
                        </div>
                    </div>
                    @endif
                <div class="form-group form-floating-label">
                    <div class="user-icon"><i class="fas fas fa-user"></i></div>
                    <input type="text" id="username" name="email" class="form-control input-border-bottom" autocomplete="off" required>
                    <label for="username" class="placeholder">Username</label>
                    <div class="invalid-feedback">Username tidak boleh kosong.</div>
                </div>

                <div class="form-group form-floating-label">
                    <div class="user-icon"><i class="fas fa-lock"></i></div>
                    <div class="show-password"><i class="flaticon-interface"></i></div>
                    <input type="password" id="password" name="password" class="form-control input-border-bottom" autocomplete="off" required>
                    <label for="password" class="placeholder">Password</label>
                    <div class="invalid-feedback">Password tidak boleh kosong.</div>
                </div>

                <div class="form-action mt-2">
                    <!-- button login -->
                    <input type="submit" name="login" value="LOGIN" class="btn btn-secondary btn-rounded btn-login btn-block" style="margin-bottom:5px;">
                    <a href="{{route('mahasiswa.signup')}}"><input type="button" name="Sign Up" value="SIGN UP" class="btn btn-success btn-rounded btn-login btn-block"></a>
                </div>

                <!-- footer -->
                <div class="login-footer mt-5">
                    <span class="msg">&copy; 2021 -</span>
                    <a href="#" class="text-brand">Fakultas Matematika Dan Ilmu Pengetahuan Alam</a>.
                </div>
            </form>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ url('public/assetsnew/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ url('public/assetsnew/js/core/popper.min.js') }}"></script>
    <script src="{{ url('public/assetsnew/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ url('public/assetsnew/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>

    <!-- Template JS -->
    <script src="{{ url('public/assetsnew/js/ready.js') }}"></script>

    <!-- Custom Scripts -->
    <script src="{{ url('public/assetsnew/js/form-validation.js') }}"></script>
</body>
    
</html>