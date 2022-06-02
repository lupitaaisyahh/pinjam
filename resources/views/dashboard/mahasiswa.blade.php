@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('css')
@endsection

@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-5">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-home mr-2"></i> Dashboard</h4>
            </div>
         </div>
      </div>
   </div>
   <div class="page-inner mt--5">
      <div class="row row-card-no-pd mt--2">
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body ">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-secondary" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Barang Dalam Proses</p>
                           <h4 class="card-title">{{$riwayatbarang['proses']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body ">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-inbox text-success" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Barang Sedang Dipinjam</p>
                           <h4 class="card-title">{{$riwayatbarang['pinjam']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-archive text-warning" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Barang Sudah Dikembalikan</p>
                           <h4 class="card-title">{{$riwayatbarang['kembali']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row row-card-no-pd mt--2">
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body ">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="fas fa-building text-secondary" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Ruangan Dalam Proses</p>
                           <h4 class="card-title">{{$riwayatruangan['proses']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body ">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-interface-1 text-success" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Ruangan Sedang Dipinjam</p>
                           <h4 class="card-title">{{$riwayatruangan['pinjam']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body">
                  <div class="row">
                     <div class="col-5">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-arrows-1 text-warning" style="font-size: 41px;"></i>
                        </div>
                     </div>
                     <div class="col-7 col-stats">
                        <div class="numbers">
                           <p class="card-category">Ruangan Sudah Dikembalikan</p>
                           <h4 class="card-title">{{$riwayatruangan['kembali']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body ">
                  <div class="row align-items-center">
                     <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                           <i class="fas fa-box"></i>
                        </div>
                     </div>
                     <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                           <p class="card-category">Data Barang</p>
                           <h4 class="card-title">{{$data['barang']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                           <i class="fas fa-building"></i>
                        </div>
                     </div>
                     <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                           <p class="card-category">Data Gedung</p>
                           <h4 class="card-title">{{$data['gedung']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                           <i class="fas fa-home"></i>
                        </div>
                     </div>
                     <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                           <p class="card-category">Data Ruangan</p>
                           <h4 class="card-title">{{$data['ruangan']}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="mt-2 pb-3">
      <div class="row">
         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Barang Sudah Terlewat </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayat['lewat'])): ?>
               @foreach($riwayat['lewat'] as $key  => $riwayatlwt)

               <?php 
                  $iditems = Helper::ambilIdItemsBarang($riwayatlwt);
                  foreach ($iditems as $barangs){
                    $datax[$riwayatlwt][] = Helper::ambilBarang($barangs->barang_id).' ('.$barangs->jumlah.') |';
                }
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiBarang($riwayatlwt, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{implode(" ",$datax[$riwayatlwt])}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-danger btn-round btn-xs">
                           <i class="fa fa-exclamation-triangle"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Barang Tempo Hari Ini </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayat['hariini'])): ?>
               @foreach($riwayat['hariini'] as $key  => $riwayatlwt)

               <?php 
                  $iditems = Helper::ambilIdItemsBarang($riwayatlwt);
                  foreach ($iditems as $barangs){
                    $dataz[$riwayatlwt][] = Helper::ambilBarang($barangs->barang_id).' ('.$barangs->jumlah.')';
                }
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiBarang($riwayatlwt, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{implode(" ",$dataz[$riwayatlwt])}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-warning btn-round btn-xs">
                           <i class="fa fa-exclamation"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Barang Tempo Besok </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayat['satuhari'])): ?>
               @foreach($riwayat['satuhari'] as $key  => $riwayatlwt)

               <?php 
                  $iditems = Helper::ambilIdItemsBarang($riwayatlwt);
                  foreach ($iditems as $barangs){
                    $datay[$riwayatlwt][] = Helper::ambilBarang($barangs->barang_id).' ('.$barangs->jumlah.')';
                }
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiBarang($riwayatlwt, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{implode(" ",$datay[$riwayatlwt])}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-warning btn-round btn-xs">
                           <i class="fa fa-exclamation"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>
      </div>

      <!-- peminjaman ruangan -->
      <div class="row">
         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Ruangan Sudah Terlewat </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayats['lewat'])): ?>
               @foreach($riwayats['lewat'] as $key  => $riwayatlwts)
               <?php
                  $idruangan = Helper::ambilTransaksiRuangan($riwayatlwts, 'ruangan_id');
                  $idgedung = Helper::AmbilRuangan($idruangan,'gedung_id');
                  $ruangan = Helper::AmbilRuangan($idruangan,'nama');
                  $gedung = Helper::AmbilGedung($idgedung);
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiRuangan($riwayatlwts, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{$gedung}} - {{$ruangan}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-danger btn-round btn-xs">
                           <i class="fa fa-exclamation-triangle"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Ruangan Tempo Hari Ini </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayats['hariini'])): ?>
               @foreach($riwayats['hariini'] as $key  => $riwayatlwts)
               <?php
                  $idruangan = Helper::ambilTransaksiRuangan($riwayatlwts, 'ruangan_id');
                  $idgedung = Helper::AmbilRuangan($idruangan,'gedung_id');
                  $ruangan = Helper::AmbilRuangan($idruangan,'nama');
                  $gedung = Helper::AmbilGedung($idgedung);
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiRuangan($riwayatlwts, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{$gedung}} - {{$ruangan}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-danger btn-round btn-xs">
                           <i class="fa fa-exclamation-triangle"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">Peminjaman Ruangan Tempo Besok </div>
               </div>
               <div class="card-body pb-0">
               <?php if (isset($riwayats['satuhari'])): ?>
               @foreach($riwayats['satuhari'] as $key  => $riwayatlwts)
               <?php
                  $idruangan = Helper::ambilTransaksiRuangan($riwayatlwts, 'ruangan_id');
                  $idgedung = Helper::AmbilRuangan($idruangan,'gedung_id');
                  $ruangan = Helper::AmbilRuangan($idruangan,'nama');
                  $gedung = Helper::AmbilGedung($idgedung);
               ?>
                  <div class="d-flex">
                     <div class="avatar">
                        <div class="icon-big2 text-center">
                           <i class="flaticon-box-2 text-primary" style="font-size: 32px;"></i>
                        </div>
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                        <h6 class="fw-bold mb-1">Peminjaman {{ Helper::indonesian_date(Helper::ambilTransaksiRuangan($riwayatlwts, 'tgl_transaksi'),'j F Y') }}</h6>
                        <small class="text-muted">{{$gedung}} - {{$ruangan}}</small>
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                        <button class="btn btn-icon btn-danger btn-round btn-xs">
                           <i class="fa fa-exclamation-triangle"></i>
                        </button>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               @endforeach
               <?php else: ?>
                  <div class="d-flex">
                     <div class="avatar">
                        
                     </div>
                     <div class="flex-1 pt-1 ml-2">
                     </div>
                     <div class="d-flex ml-auto align-items-center">
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
               <?php endif ?>
               </div>
            </div>
         </div>
         
      </div>
   </div>


   <?php if (Auth::user()->status == 0 || Auth::user()->status == 2): ?>
   <div class="modal fade in" id="infoDemo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body">
               <div class="row align-items-center p-2 p-sm-4">
                  <div class="col-lg-4 mb-4 mb-lg-0">
                     <img class="img-fluid" src="{{ url('public/assetsnew/img/helpdesk-hero.svg') }}">
                  </div>
                  <div class="col-lg-8">
                     <h4 class="mb-2">Selamat Datang !!</h4>
                     <p class="text-muted mb-4">Akun anda belum terverifikasi, silahkan update profil terkebih dahulu.</p>
                     <div class="d-grid gap-2 d-lg-flex justify-content-lg-start">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Ya, Saya Mengerti</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
      $('#infoDemo').modal('show');
   </script>
   <?php endif ?>
</div>
@endsection
@section('js')
<script>
   $("#datadashboard").addClass("active");
</script>
@endsection