<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistem Informasi Peminjaman Sarana Prasarana" />
        <meta name="author" content="Lupitha Aisyah" />
        <title>Sistem Informasi Peminjaman Sarana Prasarana</title>
        <link rel="icon" href="{{ url('public/img/logo.png') }}" type="image/x-icon" />
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
        <link rel="stylesheet" href="{{ url('public/assetsnew/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/assetsnew/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/assetsnew/css/atlantis.min.css') }}">
        <script src="{{ url('public/assetsnew/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/core/popper.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/core/bootstrap.min.js') }}"></script>
        <link href="{{ url('public/assetsnew/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
        @yield('css')
    </head>
    <body>
        <div class="wrapper">
            <div class="main-header">
                <div class="logo-header" data-background-color="purple">
                    <a href="#" class="logo">
                        <div class="navbar-brand">
                            <span><i class="fab fa-stripe-s fa-lg text-warning"></i></span>
                            <span class="text-white">arana Prasarana</span>
                        </div>
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                    </span>
                    </button>
                    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                        </button>
                    </div>
                </div>
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="purple2">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLogout" style="color: #ffffff;background-color: #5c55bf!important;">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="sidebar sidebar-style-2">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <div class="user">
                            <div class="avatar-sm float-left mr-2">
                                <img src="{{ url('public/assetsnew/img/avatar-1.png') }}" alt="image profile" class="avatar-img rounded-circle">
                            </div>
                            <div class="info">
                                <a>
                                <span>
                                {{Auth::user()->nama}}
                                    <span class="user-level">
                                        @auth("admin")
                                            Administrator
                                        @endauth
                                        @auth("mahasiswa")
                                            Mahasiswa
                                        @endauth
                                        @auth("wakildekan")
                                            Wakil Dekan
                                        @endauth
                                        @auth("dosen")
                                            Dosen
                                        @endauth
                                    </span>
                                </span>
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-secondary">
                            @auth("admin")
                            <li class="nav-item" id="datadashboard">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Master</h4>
                            </li>
                            <li class="nav-item" id="masterbarang">
                                <a data-toggle="collapse" href="#barang">
                                    <i class="fas fa-clone"></i>
                                    <p>Barang</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="barang">
                                    <ul class="nav nav-collapse">
                                        <li id="databarang">
                                            <a href="{{ route('admin.master.barang.index') }}">
                                            <span class="sub-item">Data Barang</span>
                                            </a>
                                        </li>
                                        <li id="jenisbarang">
                                            <a href="{{ route('admin.master.jenisbarang.index') }}">
                                            <span class="sub-item">Jenis Barang</span>
                                            </a>
                                        </li>
                                        <li id="satuanbarang">
                                            <a href="{{ route('admin.master.satuanbarang.index') }}">
                                            <span class="sub-item">Satuan Barang</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item" id="mastergedung">
                                <a data-toggle="collapse" href="#gedung">
                                    <i class="fas fa-building"></i>
                                    <p>Gedung</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="gedung">
                                    <ul class="nav nav-collapse">
                                        <li id="datagedung">
                                            <a href="{{ route('admin.master.gedung.index') }}">
                                            <span class="sub-item">Data Gedung</span>
                                            </a>
                                        </li>
                                        <li id="dataruangan">
                                            <a href="{{ route('admin.master.ruangan.index') }}">
                                            <span class="sub-item">Data Ruangan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Manajemen User</h4>
                            </li>
                            <li class="nav-item" id="manajemenuser">
                                <a data-toggle="collapse" href="#pengguna">
                                    <i class="fas fa-users"></i>
                                    <p>Pengguna</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="pengguna">
                                    <ul class="nav nav-collapse">
                                        <li id="datamahasiswa">
                                            <a href="{{ route('admin.kelolauser.mahasiswa.index') }}">
                                            <span class="sub-item">Mahasiswa</span>
                                            </a>
                                        </li>
                                        <li id="datadosen">
                                            <a href="{{ route('admin.kelolauser.dosen.index') }}">
                                            <span class="sub-item">Dosen</span>
                                            </a>
                                        </li>
                                        <li id="datawakildekan">
                                            <a href="{{ route('admin.kelolauser.wakildekan.index') }}">
                                            <span class="sub-item">Wakil Dekan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Kelola Data</h4>
                            </li>
                            <li class="nav-item" id="peminjamanbarang">
                                <a href="{{ route('admin.keloladata.peminjamanbarang.index') }}">
                                    <i class="flaticon-box-2"></i>
                                    <p>Peminjaman Barang</p>
                                </a>
                            </li>
                            <li class="nav-item" id="pengembalianbarang">
                                <a href="{{ route('admin.keloladata.pengembalianbarang.index') }}">
                                    <i class="flaticon-box-2"></i>
                                    <p>Pengembalian Barang</p>
                                </a>
                            </li>
                            <li class="nav-item" id="peminjamanruangan">
                                <a href="{{ route('admin.keloladata.peminjamanruangan.index') }}">
                                    <i class="fas fa-building"></i>
                                    <p>Peminjaman Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item" id="pengembalianruangan">
                                <a href="{{ route('admin.keloladata.pengembalianruangan.index') }}">
                                    <i class="fas fa-building"></i>
                                    <p>Pengembalian Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Laporan</h4>
                            </li>
                            <li class="nav-item" id="lappeminjamanbarang">
                                <a href="{{ route('admin.laporan.peminjamanbarang.index') }}">
                                    <i class="fas fa-book-open"></i>
                                    <p>Peminjaman Barang</p>
                                </a>
                            </li>
                            <li class="nav-item" id="lappeminjamanruanganwd">
                                <a href="{{ route('admin.laporan.peminjamanruangan.index') }}">
                                    <i class="fas fa-book-open"></i>
                                    <p>Peminjaman Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Pengaturan</h4>
                            </li>
                            <li class="nav-item" id="porfiladmin">
                                <a href="{{ route('admin.profile', Auth::user()->id) }}">
                                    <i class="fas fa-user"></i>
                                    <p>Manajemen User</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Bantuan</h4>
                            </li>
                            
                            @endauth
                            @auth("mahasiswa")
                                <li class="nav-item">
                                    <a href="{{ route('mahasiswa.dashboard') }}">
                                        <i class="fas fa-home"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Transaksi</h4>
                                </li>
                                <li class="nav-item" id="peminjamanbarang">
                                    <a href="{{ route('mahasiswa.transaksi.peminjamanbarang.index') }}">
                                        <i class="flaticon-box-2"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="peminjamanruangan">
                                    <a href="{{ route('mahasiswa.transaksi.peminjamanruangan.index') }}">
                                        <i class="fas fa-building"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Laporan</h4>
                                </li>
                                <li class="nav-item" id="lappeminjamanbarang">
                                    <a href="{{ route('mahasiswa.laporan.peminjamanbarang.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="lappeminjamanruangan">
                                    <a href="{{ route('mahasiswa.laporan.peminjamanruangan.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Pengaturan</h4>
                                </li>
                                <li class="nav-item" id="profilmahasiswa">
                                    <a href="{{ route('mahasiswa.profile', Auth::user()->id) }}">
                                        <i class="fas fa-user"></i>
                                        <p>Manajemen User</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Bantuan</h4>
                                </li>
                                
                            @endauth
                            @auth("dosen")
                                <li class="nav-item">
                                    <a href="{{ route('dosen.dashboard') }}">
                                        <i class="fas fa-home"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Transaksi</h4>
                                </li>
                                <li class="nav-item" id="peminjamanbarang">
                                    <a href="{{ route('dosen.transaksi.peminjamanbarang.index') }}">
                                        <i class="flaticon-box-2"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="peminjamanruangan">
                                    <a href="{{ route('dosen.transaksi.peminjamanruangan.index') }}">
                                        <i class="fas fa-building"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Laporan</h4>
                                </li>
                                <li class="nav-item" id="lappeminjamanbarang">
                                    <a href="{{ route('dosen.laporan.peminjamanbarang.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="lappeminjamanruangan">
                                    <a href="{{ route('dosen.laporan.peminjamanruangan.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Pengaturan</h4>
                                </li>
                                <li class="nav-item" id="profildosen">
                                    <a href="{{ route('dosen.profil', Auth::user()->id) }}">
                                        <i class="fas fa-user"></i>
                                        <p>Manajemen User</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Bantuan</h4>
                                </li>
                                
                            @endauth
                            @auth("wakildekan")
                                <li class="nav-item">
                                    <a href="{{ route('wakildekan.dashboard') }}">
                                        <i class="fas fa-home"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Kelola Data</h4>
                                </li>
                                <li class="nav-item" id="peminjamanbarang">
                                    <a href="{{ route('wakildekan.keloladata.peminjamanbarang.index') }}">
                                        <i class="flaticon-box-2"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="peminjamanruangan">
                                    <a href="{{ route('wakildekan.keloladata.peminjamanruangan.index') }}">
                                        <i class="fas fa-building"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Laporan</h4>
                                </li>
                                <li class="nav-item" id="lappeminjamanbarang">
                                    <a href="{{ route('wakildekan.laporan.peminjamanbarang.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="lappeminjamanruanganwd">
                                    <a href="{{ route('wakildekan.laporan.peminjamanruangan.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        <p>Peminjaman Ruangan</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Pengaturan</h4>
                                </li>
                                <li class="nav-item" id="profilwakildekan">
                                    <a href="{{ route('wakildekan.profil', Auth::user()->id) }}">
                                        <i class="fas fa-user"></i>
                                        <p>Manajemen User</p>
                                    </a>
                                </li>
                                <li class="nav-section">
                                    <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <h4 class="text-section">Bantuan</h4>
                                </li>
                                
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-panel">
                @yield('content')
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright ml-auto">
                            <span>Copyright &copy; 2022 - <a href="#" class="text-brand">Fakultas Matematika dan Ilmu Pengetahuan Alam</a>. All rights reserved.</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-sign-out-alt mr-2"></i>Logout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah Anda yakin ingin logout?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Batal</button>
                        @auth("admin")
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-round">Ya, Logout</a>
                        @endauth
                        @auth("mahasiswa")
                            <a href="{{ route('mahasiswa.logout') }}" class="btn btn-danger btn-round">Ya, Logout</a>
                        @endauth
                        @auth("wakildekan")
                            <a href="{{ route('wakildekan.logout') }}" class="btn btn-danger btn-round">Ya, Logout</a>
                        @endauth
                        @auth("dosen")
                            <a href="{{ route('dosen.logout') }}" class="btn btn-danger btn-round">Ya, Logout</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ url('public/assetsnew/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/plugin/datatables/datatables.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/atlantis.min.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/plugin.js') }}"></script>
        <script src="{{ url('public/assetsnew/js/form-validation.js') }}"></script>.
        <script src="{{ url('public/assetsnew/js/plugin/sweetalert/sweetalert.min.js') }}"></script>.
        <script src="{{ url('public/assetsnew/plugins/select2/dist/js/select2.full.min.js') }}"></script>
        <script>
            $('.select2').select2();
            $('.datepicker').datepicker({
                showButtonPanel: true
            }).datepicker("setDate", "0");
            
            @if(Session::has('pesan'))
                swal("Sukses !", "<?php echo Session::get('pesan') ?>", {
                    icon : "success",
                    buttons: {                  
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                });
            @endif
            
            @if(Session::has('salah'))
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '<?php echo Session::get('salah') ?>',
                position: 'center',
                showConfirmButton: false,
                timer: 3000
            })
            @endif
            
            $(document).on("click", ".hapusbtn", function (e) {
                    var id = $(this).data("id");
                    $("#idhapus").val();
                    $("#idhapus").val(id);
                    e.preventDefault();
                    swal({
                        title: 'Anda yakin ?',
                        text: "Data ini akan dihapus!",
                        type: 'warning',
                        buttons:{
                            confirm: {
                                text : 'Hapus',
                                className : 'btn btn-primary'
                            },
                            cancel: {
                                visible: true,
                                text : 'Batal',
                                className: 'btn btn-secondary'
                            }
                        }
                    }).then((Delete) => {
                        if (Delete) {
                            $("#formhapus").submit();
                        } else {
                            swal.close();
                        }
                    });
            });

            $(document).on("click", ".hapusbtns", function (e) {
                var id = $(this).data("id");
                $("#idhapuss").val();
                $("#idhapuss").val(id);
                e.preventDefault();
                swal({
                    title: 'Anda yakin ?',
                    text: "Data ini akan dihapus!",
                    type: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Hapus',
                            className : 'btn btn-primary'
                        },
                        cancel: {
                            visible: true,
                            text : 'Batal',
                            className: 'btn btn-secondary'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        $("#formhapuss").submit();
                    } else {
                        swal.close();
                    }
                });
            });
            
            $('.datepick').datepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                showButtonPanel: true
            });
            
            $('.datepickerx').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            
            $('#datepicker').datepicker({
              autoclose: true,
              todayHighlight: true
            });
            
            $(document).on('keyup', '.rupiah',function(e) {
                $(this).val(formatRupiah(this.value, ""));
            });
            
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }
                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
            }
        </script>
        @yield('js')
    </body>
</html>