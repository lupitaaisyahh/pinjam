@extends('layouts.app')
@section('title', 'Dashboard Operator')

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
                           <h4 class="card-title">{{$riwayat['sedang']}}</h4>
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
                           <h4 class="card-title">{{$riwayat['kembali']}}</h4>
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
                           <i class="fas fa-clone"></i>
                        </div>
                     </div>
                     <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                           <p class="card-category">Data Jenis Barang</p>
                           <h4 class="card-title">{{$data['jenis']}}</h4>
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
      <div class="card">
         <div class="card-header">
            <div class="card-title"><i class="fas fa-info-circle mr-2"></i> Data Riwayat Barang Sedang Dipinjam</div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="basic-datatables" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Jenis Barang</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Satuan</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td width="50" class="text-center">1</td>
                        <td width="200">Gesapax 500 SC</td>
                        <td width="150">Herbisida</td>
                        <td width="70" class="text-right"><span class="badge badge-warning">10</span></td>
                        <td width="70">Liter</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
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
                     <p class="text-muted mb-4">Pada Sistem Informasi Peminjaman Sarana Prasarana FMIPA Untan.</p>
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
</div>
@endsection