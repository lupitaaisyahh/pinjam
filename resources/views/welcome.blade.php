
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Peminjaman Sarana Prasarana</title>
    <meta charset="UTF-8">
    <meta name="description" content="Sistem Informasi Peminjaman Sarana Prasarana">
    <meta name="keywords" content="untan, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('public/img/logo.png') }}" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/front/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/themify-icons.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/owl.carousel.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/front/css/style.css') }}"/>


</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <header class="header-section">
        
    </header>


    <nav class="nav-section">
        <div class="container">
            <ul class="main-menu">
                <li><a href="#hero"></a></li>
            </ul>
        </div>
    </nav>

    <section id="hero" class="hero-section">
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{ url('public/front/bg.jpg') }}">
                <div class="hs-text">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2 class="hs-title"><b>Sistem Informasi Peminjaman Sarana Prasarana</b></h2>
                                <p class="hs-des">Sistem Informasi Peminjaman Saran Prasarana Fakultas Matematika dan Ilmu Pengetahuan Alam</p>
                                <a href="{{ route('mahasiswa.dashboard') }}"><button class="site-btn">Mahasiswa</button></a>                   
                                <a href="{{ route('dosen.dashboard') }}"><button class="site-btn">Dosen</button></a>
                                <a href="{{ route('wakildekan.dashboard') }}"><button class="site-btn">Wakil Dekan</button></a>
                                <a href="{{ route('admin.dashboard') }}"><button class="site-btn">Admin</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-section">
        <div class="copyright">
            <div class="container">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Fakultas Matematika dan Ilmu Pengetahuan Alam</p>
            </div>      
        </div>
    </footer>
    <script src="{{ url('public/front/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('public/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('public/front/js/jquery.countdown.js') }}"></script>
    <script src="{{ url('public/front/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ url('public/front/js/magnific-popup.min.js') }}"></script>
    <script src="{{ url('public/front/js/main.js') }}"></script>
    
</body>
</html>