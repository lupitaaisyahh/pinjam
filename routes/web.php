<?php
Auth::routes();

Route::prefix('/')->group(function() {
    Route::get('/', 'HomeController@index')->name('frontend');
    Route::get('/mahasiswa', 'Dashboard\MahasiswaController@index')->name('mahasiswa.dashboard');
    Route::get('/login', 'Auth\MahasiswaLoginController@showLoginForm')->name('mahasiswa.login');
    Route::get('/signup', 'Auth\MahasiswaLoginController@showSignupForm')->name('mahasiswa.signup');
    Route::get('/logout', 'Auth\MahasiswaLoginController@logout')->name('mahasiswa.logout');
    Route::get('profil/{id}', 'Dashboard\MahasiswaController@profil')->name('mahasiswa.profile');
    // post
    Route::post('/ubahprofil', 'Dashboard\MahasiswaController@ubahprofil')->name('mahasiswa.ubahprofil');
    Route::post('/login', 'Auth\MahasiswaLoginController@login')->name('mahasiswa.logins');
    Route::post('/signups', 'Auth\MahasiswaLoginController@signups')->name('mahasiswa.signups');
});

Route::group(['prefix' => 'mahasiswa', 'namespace' => 'Mahasiswa'], function() {
    Route::group(['prefix' => 'transaksi', 'namespace' => 'Transaksi'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('mahasiswa.transaksi.peminjamanbarang.index');
            //post
            Route::post('/tambah', 'PeminjamanBarangController@tambah')->name('mahasiswa.transaksi.peminjamanbarang.tambah');
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('mahasiswa.transaksi.peminjamanbarang.hapus');
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('mahasiswa.transaksi.peminjamanruangan.index');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('mahasiswa.transaksi.peminjamanruangan.detail');
            //post
            Route::post('/tambah', 'PeminjamanRuanganController@tambah')->name('mahasiswa.transaksi.peminjamanruangan.tambah');
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('mahasiswa.transaksi.peminjamanruangan.hapus');
        });
    });
    Route::group(['prefix' => 'laporan', 'namespace' => 'Laporan'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('mahasiswa.laporan.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('mahasiswa.laporan.peminjamanbarang.data');
            Route::get('/detail/{id}', 'PeminjamanBarangController@detail')->name('mahasiswa.laporan.peminjamanbarang.detail');
            //post
            Route::post('/pengembalian', 'PeminjamanBarangController@pengembalian')->name('mahasiswa.laporan.peminjamanbarang.pengembalian');
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('mahasiswa.laporan.peminjamanbarang.hapus');
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('mahasiswa.laporan.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('mahasiswa.laporan.peminjamanruangan.data');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('mahasiswa.laporan.peminjamanruangan.detail');
            //post
            Route::post('/pengembalian', 'PeminjamanRuanganController@pengembalian')->name('mahasiswa.laporan.peminjamanruangan.pengembalian');
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('mahasiswa.laporan.peminjamanruangan.hapus');
        });
    });
});

Route::prefix('admin')->group(function() {
    Route::get('/', 'Dashboard\AdminController@index')->name('admin.dashboard');
    Route::get('profil/{id}', 'Dashboard\AdminController@profil')->name('admin.profile');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    // post
    Route::post('/ubahprofil', 'Dashboard\AdminController@ubahprofil')->name('admin.ubahprofil');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.logins');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function() {
        // master barang
        Route::prefix('barang')->group(function() {
            Route::get('/', 'BarangController@index')->name('admin.master.barang.index');
            Route::get('/data', 'BarangController@data')->name('admin.master.barang.data');
            //post
            Route::post('/tambah', 'BarangController@tambah')->name('admin.master.barang.tambah');
            Route::post('/ubah', 'BarangController@ubah')->name('admin.master.barang.ubah');
            Route::post('/hapus', 'BarangController@hapus')->name('admin.master.barang.hapus');
        });
        Route::prefix('satuanbarang')->group(function() {
            Route::get('/', 'SatuanController@index')->name('admin.master.satuanbarang.index');
            Route::get('/data', 'SatuanController@data')->name('admin.master.satuanbarang.data');
            //post
            Route::post('/tambah', 'SatuanController@tambah')->name('admin.master.satuanbarang.tambah');
            Route::post('/ubah', 'SatuanController@ubah')->name('admin.master.satuanbarang.ubah');
            Route::post('/hapus', 'SatuanController@hapus')->name('admin.master.satuanbarang.hapus');
        });
        Route::prefix('jenisbarang')->group(function() {
            Route::get('/', 'JenisBarangController@index')->name('admin.master.jenisbarang.index');
            Route::get('/data', 'JenisBarangController@data')->name('admin.master.jenisbarang.data');
            //post
            Route::post('/tambah', 'JenisBarangController@tambah')->name('admin.master.jenisbarang.tambah');
            Route::post('/ubah', 'JenisBarangController@ubah')->name('admin.master.jenisbarang.ubah');
            Route::post('/hapus', 'JenisBarangController@hapus')->name('admin.master.jenisbarang.hapus');
        });
        // endmaster barang
        // master gedung
        Route::prefix('gedung')->group(function() {
            Route::get('/', 'GedungController@index')->name('admin.master.gedung.index');
            Route::get('/data', 'GedungController@data')->name('admin.master.gedung.data');
            //post
            Route::post('/tambah', 'GedungController@tambah')->name('admin.master.gedung.tambah');
            Route::post('/ubah', 'GedungController@ubah')->name('admin.master.gedung.ubah');
            Route::post('/hapus', 'GedungController@hapus')->name('admin.master.gedung.hapus');
        });
        Route::prefix('ruangan')->group(function() {
            Route::get('/', 'RuanganController@index')->name('admin.master.ruangan.index');
            Route::get('/data', 'RuanganController@data')->name('admin.master.ruangan.data');
            //post
            Route::post('/tambah', 'RuanganController@tambah')->name('admin.master.ruangan.tambah');
            Route::post('/ubah', 'RuanganController@ubah')->name('admin.master.ruangan.ubah');
            Route::post('/hapus', 'RuanganController@hapus')->name('admin.master.ruangan.hapus');
        });
    });
    Route::group(['prefix' => 'kelolauser', 'namespace' => 'Kelolauser'], function() {
        Route::prefix('mahasiswa')->group(function() {
            Route::get('/', 'MahasiswaController@index')->name('admin.kelolauser.mahasiswa.index');
            Route::get('/data', 'MahasiswaController@data')->name('admin.kelolauser.mahasiswa.data');
            Route::get('/detail/{id}', 'MahasiswaController@detail')->name('admin.kelolauser.mahasiswa.detail');
            //post
            Route::post('/verifikasi', 'MahasiswaController@verifikasi')->name('admin.kelolauser.mahasiswa.verifikasi');
            Route::post('/tambah', 'MahasiswaController@tambah')->name('admin.kelolauser.mahasiswa.tambah');
            Route::post('/ubah', 'MahasiswaController@ubah')->name('admin.kelolauser.mahasiswa.ubah');
            Route::post('/hapus', 'MahasiswaController@hapus')->name('admin.kelolauser.mahasiswa.hapus');
        });
        Route::prefix('dosen')->group(function() {
            Route::get('/', 'DosenController@index')->name('admin.kelolauser.dosen.index');
            Route::get('/data', 'DosenController@data')->name('admin.kelolauser.dosen.data');
            //post
            Route::post('/tambah', 'DosenController@tambah')->name('admin.kelolauser.dosen.tambah');
            Route::post('/ubah', 'DosenController@ubah')->name('admin.kelolauser.dosen.ubah');
            Route::post('/hapus', 'DosenController@hapus')->name('admin.kelolauser.dosen.hapus');
        });
        Route::prefix('operator')->group(function() {
            Route::get('/', 'OperatorController@index')->name('admin.kelolauser.operator.index');
            Route::get('/data', 'OperatorController@data')->name('admin.kelolauser.operator.data');
            //post
            Route::post('/tambah', 'OperatorController@tambah')->name('admin.kelolauser.operator.tambah');
            Route::post('/ubah', 'OperatorController@ubah')->name('admin.kelolauser.operator.ubah');
            Route::post('/hapus', 'OperatorController@hapus')->name('admin.kelolauser.operator.hapus');
        });
        Route::prefix('wakildekan')->group(function() {
            Route::get('/', 'WakilDekanController@index')->name('admin.kelolauser.wakildekan.index');
            Route::get('/data', 'WakilDekanController@data')->name('admin.kelolauser.wakildekan.data');
            //post
            Route::post('/tambah', 'WakilDekanController@tambah')->name('admin.kelolauser.wakildekan.tambah');
            Route::post('/ubah', 'WakilDekanController@ubah')->name('admin.kelolauser.wakildekan.ubah');
            Route::post('/hapus', 'WakilDekanController@hapus')->name('admin.kelolauser.wakildekan.hapus');
        });
    });
    Route::group(['prefix' => 'keloladata', 'namespace' => 'Keloladata'], function() {
        // kelola data  barang
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('admin.keloladata.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('admin.keloladata.peminjamanbarang.data');
            Route::get('/datas', 'PeminjamanBarangController@datas')->name('admin.keloladata.peminjamanbarang.datas');
            Route::get('/detail/{id}', 'PeminjamanBarangController@detail')->name('admin.keloladata.peminjamanbarang.detail');
            Route::get('/details/{id}', 'PeminjamanBarangController@details')->name('admin.keloladata.peminjamanbarang.details');
            //post
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('admin.keloladata.peminjamanbarang.hapus');
            Route::post('/hapuss', 'PeminjamanBarangController@hapuss')->name('admin.keloladata.peminjamanbarang.hapuss');
            Route::post('/verifikasi', 'PeminjamanBarangController@verifikasi')->name('admin.keloladata.peminjamanbarang.verifikasi');
            Route::post('/verifikasis', 'PeminjamanBarangController@verifikasis')->name('admin.keloladata.peminjamanbarang.verifikasis');
        });
        Route::prefix('pengembalianbarang')->group(function() {
            Route::get('/', 'PengembalianBarangController@index')->name('admin.keloladata.pengembalianbarang.index');
            Route::get('/data', 'PengembalianBarangController@data')->name('admin.keloladata.pengembalianbarang.data');
            Route::get('/datas', 'PengembalianBarangController@datas')->name('admin.keloladata.pengembalianbarang.datas');
            Route::get('/detail/{id}', 'PengembalianBarangController@detail')->name('admin.keloladata.pengembalianbarang.detail');
            Route::get('/details/{id}', 'PengembalianBarangController@details')->name('admin.keloladata.pengembalianbarang.details');
            //post
            Route::post('/verifikasi', 'PengembalianBarangController@verifikasi')->name('admin.keloladata.pengembalianbarang.verifikasi');
            Route::post('/verifikasis', 'PengembalianBarangController@verifikasis')->name('admin.keloladata.pengembalianbarang.verifikasis');
        });
        
        // kelola data ruangan
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('admin.keloladata.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('admin.keloladata.peminjamanruangan.data');
            Route::get('/datas', 'PeminjamanRuanganController@datas')->name('admin.keloladata.peminjamanruangan.datas');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('admin.keloladata.peminjamanruangan.detail');
            Route::get('/details/{id}', 'PeminjamanRuanganController@details')->name('admin.keloladata.peminjamanruangan.details');
            //post
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('admin.keloladata.peminjamanruangan.hapus');
            Route::post('/hapuss', 'PeminjamanRuanganController@hapuss')->name('admin.keloladata.peminjamanruangan.hapuss');
            Route::post('/verifikasi', 'PeminjamanRuanganController@verifikasi')->name('admin.keloladata.peminjamanruangan.verifikasi');
            Route::post('/verifikasis', 'PeminjamanRuanganController@verifikasis')->name('admin.keloladata.peminjamanruangan.verifikasis');
        });
        Route::prefix('pengembalianruangan')->group(function() {
            Route::get('/', 'PengembalianRuanganController@index')->name('admin.keloladata.pengembalianruangan.index');
            Route::get('/data', 'PengembalianRuanganController@data')->name('admin.keloladata.pengembalianruangan.data');
            Route::get('/datas', 'PengembalianRuanganController@datas')->name('admin.keloladata.pengembalianruangan.datas');
            Route::get('/detail/{id}', 'PengembalianRuanganController@detail')->name('admin.keloladata.pengembalianruangan.detail');
            Route::get('/details/{id}', 'PengembalianRuanganController@details')->name('admin.keloladata.pengembalianruangan.details');
            //post
            Route::post('/hapus', 'PengembalianRuanganController@hapus')->name('admin.keloladata.pengembalianruangan.hapus');
            Route::post('/hapuss', 'PengembalianRuanganController@hapuss')->name('admin.keloladata.pengembalianruangan.hapuss');
            Route::post('/verifikasi', 'PengembalianRuanganController@verifikasi')->name('admin.keloladata.pengembalianruangan.verifikasi');
            Route::post('/verifikasis', 'PengembalianRuanganController@verifikasis')->name('admin.keloladata.pengembalianruangan.verifikasis');
        });
    });

    Route::group(['prefix' => 'laporan', 'namespace' => 'Laporan'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('admin.laporan.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('admin.laporan.peminjamanbarang.data');
            Route::get('/datas', 'PeminjamanBarangController@datas')->name('admin.laporan.peminjamanbarang.datas');
            Route::get('/datass', 'PeminjamanBarangController@datass')->name('admin.laporan.peminjamanbarang.datass');

            Route::prefix('detail')->group(function() {
                Route::get('/{id}', 'PeminjamanBarangDetailController@index')->name('admin.laporan.peminjamanbarang.detail.index');
                Route::get('/data/{id}', 'PeminjamanBarangDetailController@data')->name('admin.laporan.peminjamanbarang.detail.data');
                Route::get('/datas/{id}', 'PeminjamanBarangDetailController@datas')->name('admin.laporan.peminjamanbarang.detail.datas');
                Route::get('/detail/{id}', 'PeminjamanBarangDetailController@detail')->name('admin.laporan.peminjamanbarang.detail.detail');
                Route::get('/details/{id}', 'PeminjamanBarangDetailController@details')->name('admin.laporan.peminjamanbarang.detail.details');
            });
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('admin.laporan.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('admin.laporan.peminjamanruangan.data');
            Route::get('/datas', 'PeminjamanRuanganController@datas')->name('admin.laporan.peminjamanruangan.datas');
            Route::get('/datax', 'PeminjamanRuanganController@datax')->name('admin.laporan.peminjamanruangan.datax');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('admin.laporan.peminjamanruangan.detail');
            Route::get('/details/{id}', 'PeminjamanRuanganController@details')->name('admin.laporan.peminjamanruangan.details');
        });
    });
});


//Wakil Dekan
Route::prefix('wakildekan')->group(function() {
    Route::get('/', 'Dashboard\WakilDekanController@index')->name('wakildekan.dashboard');
    Route::get('/login', 'Auth\WakilDekanLoginController@showLoginForm')->name('wakildekan.logins');
    Route::get('/logout', 'Auth\WakilDekanLoginController@logout')->name('wakildekan.logout');
    Route::get('profil/{id}', 'Dashboard\WakilDekanController@profil')->name('wakildekan.profil');
    // post
    Route::post('/', 'Dashboard\WakilDekanController@indexs')->name('wakildekan.dashboards');
    Route::post('/login', 'Auth\WakilDekanLoginController@login')->name('wakildekan.login');
    Route::post('/ubahprofil', 'Dashboard\WakilDekanController@ubahprofil')->name('wakildekan.ubahprofil');
});
Route::group(['prefix' => 'wakildekan', 'namespace' => 'Wakildekan'], function() {
    Route::group(['prefix' => 'keloladata', 'namespace' => 'Keloladata'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('wakildekan.keloladata.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('wakildekan.keloladata.peminjamanbarang.data');
            Route::get('/datas', 'PeminjamanBarangController@datas')->name('wakildekan.keloladata.peminjamanbarang.datas');
            Route::get('/detail/{id}', 'PeminjamanBarangController@detail')->name('wakildekan.keloladata.peminjamanbarang.detail');
            Route::get('/details/{id}', 'PeminjamanBarangController@details')->name('wakildekan.keloladata.peminjamanbarang.details');
            //post
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('wakildekan.keloladata.peminjamanbarang.hapus');
            Route::post('/hapuss', 'PeminjamanBarangController@hapuss')->name('wakildekan.keloladata.peminjamanbarang.hapuss');
            Route::post('/verifikasi', 'PeminjamanBarangController@verifikasi')->name('wakildekan.keloladata.peminjamanbarang.verifikasi');
            Route::post('/verifikasis', 'PeminjamanBarangController@verifikasis')->name('wakildekan.keloladata.peminjamanbarang.verifikasis');
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('wakildekan.keloladata.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('wakildekan.keloladata.peminjamanruangan.data');
            Route::get('/datas', 'PeminjamanRuanganController@datas')->name('wakildekan.keloladata.peminjamanruangan.datas');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('wakildekan.keloladata.peminjamanruangan.detail');
            Route::get('/details/{id}', 'PeminjamanRuanganController@details')->name('wakildekan.keloladata.peminjamanruangan.details');
            //post
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('wakildekan.keloladata.peminjamanruangan.hapus');
            Route::post('/hapuss', 'PeminjamanRuanganController@hapuss')->name('wakildekan.keloladata.peminjamanruangan.hapuss');
            Route::post('/verifikasi', 'PeminjamanRuanganController@verifikasi')->name('wakildekan.keloladata.peminjamanruangan.verifikasi');
            Route::post('/verifikasis', 'PeminjamanRuanganController@verifikasis')->name('wakildekan.keloladata.peminjamanruangan.verifikasis');
        });
    });
    Route::group(['prefix' => 'laporan', 'namespace' => 'Laporan'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('wakildekan.laporan.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('wakildekan.laporan.peminjamanbarang.data');
            Route::get('/datas', 'PeminjamanBarangController@datas')->name('wakildekan.laporan.peminjamanbarang.datas');
            Route::get('/datass', 'PeminjamanBarangController@datass')->name('wakildekan.laporan.peminjamanbarang.datass');

            Route::prefix('detail')->group(function() {
                Route::get('/{id}', 'PeminjamanBarangDetailController@index')->name('wakildekan.laporan.peminjamanbarang.detail.index');
                Route::get('/data/{id}', 'PeminjamanBarangDetailController@data')->name('wakildekan.laporan.peminjamanbarang.detail.data');
                Route::get('/datas/{id}', 'PeminjamanBarangDetailController@datas')->name('wakildekan.laporan.peminjamanbarang.detail.datas');
                Route::get('/detail/{id}', 'PeminjamanBarangDetailController@detail')->name('wakildekan.laporan.peminjamanbarang.detail.detail');
                Route::get('/details/{id}', 'PeminjamanBarangDetailController@details')->name('wakildekan.laporan.peminjamanbarang.detail.details');
            });
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('wakildekan.laporan.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('wakildekan.laporan.peminjamanruangan.data');
            Route::get('/datas', 'PeminjamanRuanganController@datas')->name('wakildekan.laporan.peminjamanruangan.datas');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('wakildekan.laporan.peminjamanruangan.detail');
            //post
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('wakildekan.laporan.peminjamanruangan.hapus');
            Route::post('/verifikasi', 'PeminjamanRuanganController@verifikasi')->name('wakildekan.laporan.peminjamanruangan.verifikasi');
        });
    });
});

//Dosen
Route::prefix('dosen')->group(function() {
    Route::get('/', 'Dashboard\DosenController@index')->name('dosen.dashboard');
    Route::get('/login', 'Auth\DosenLoginController@showLoginForm')->name('dosen.logins');
    Route::get('/logout', 'Auth\DosenLoginController@logout')->name('dosen.logout');
    Route::get('profil/{id}', 'Dashboard\DosenController@profil')->name('dosen.profil');
    // post
    Route::post('/', 'Dashboard\DosenController@indexs')->name('dosen.dashboards');
    Route::post('/login', 'Auth\DosenLoginController@login')->name('dosen.login');
    Route::post('/ubahprofil', 'Dashboard\DosenController@ubahprofil')->name('dosen.ubahprofil');
});

Route::group(['prefix' => 'dosen', 'namespace' => 'Dosen'], function() {
    Route::group(['prefix' => 'transaksi', 'namespace' => 'Transaksi'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('dosen.transaksi.peminjamanbarang.index');
            //post
            Route::post('/tambah', 'PeminjamanBarangController@tambah')->name('dosen.transaksi.peminjamanbarang.tambah');
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('dosen.transaksi.peminjamanbarang.hapus');
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('dosen.transaksi.peminjamanruangan.index');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('dosen.transaksi.peminjamanruangan.detail');
            //post
            Route::post('/tambah', 'PeminjamanRuanganController@tambah')->name('dosen.transaksi.peminjamanruangan.tambah');
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('dosen.transaksi.peminjamanruangan.hapus');
        });
    });
    Route::group(['prefix' => 'laporan', 'namespace' => 'Laporan'], function() {
        Route::prefix('peminjamanbarang')->group(function() {
            Route::get('/', 'PeminjamanBarangController@index')->name('dosen.laporan.peminjamanbarang.index');
            Route::get('/data', 'PeminjamanBarangController@data')->name('dosen.laporan.peminjamanbarang.data');
            Route::get('/detail/{id}', 'PeminjamanBarangController@detail')->name('dosen.laporan.peminjamanbarang.detail');
            //post
            Route::post('/pengembalian', 'PeminjamanBarangController@pengembalian')->name('dosen.laporan.peminjamanbarang.pengembalian');
            Route::post('/hapus', 'PeminjamanBarangController@hapus')->name('dosen.laporan.peminjamanbarang.hapus');
        });
        Route::prefix('peminjamanruangan')->group(function() {
            Route::get('/', 'PeminjamanRuanganController@index')->name('dosen.laporan.peminjamanruangan.index');
            Route::get('/data', 'PeminjamanRuanganController@data')->name('dosen.laporan.peminjamanruangan.data');
            Route::get('/detail/{id}', 'PeminjamanRuanganController@detail')->name('dosen.laporan.peminjamanruangan.detail');
            //post
            Route::post('/pengembalian', 'PeminjamanRuanganController@pengembalian')->name('dosen.laporan.peminjamanruangan.pengembalian');
            Route::post('/hapus', 'PeminjamanRuanganController@hapus')->name('dosen.laporan.peminjamanruangan.hapus');
        });
    });
});

//Operator
Route::prefix('operator')->group(function() {
    Route::get('/', 'Dashboard\OperatorController@index')->name('operator.dashboard');
    Route::get('/login', 'Auth\OperatorLoginController@showLoginForm')->name('operator.logins');
    Route::get('/logout', 'Auth\OperatorLoginController@logout')->name('operator.logout');
    Route::get('profil/{id}', 'Dashboard\OperatorController@profil')->name('operator.profil');
    // post
    Route::post('/', 'Dashboard\OperatorController@indexs')->name('operator.dashboards');
    Route::post('/login', 'Auth\OperatorLoginController@login')->name('operator.login');
    Route::post('/ubahprofil', 'Dashboard\OperatorController@ubahprofil')->name('operator.ubahprofil');
});
