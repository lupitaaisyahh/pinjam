@extends('layouts.app')
@section('title', 'Laporan Data Peminjaman Barang')
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Laporan Data</h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white"></a>Laporan</li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a>Peminjaman Barang</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="page-inner mt--5">
        <div class="row">
            @if($errors->any())
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="fas fa-exclamation-circle"></i> Error !</h4>
                    <ul>
                        @foreach($errors->getMessages() as $this_error)
                            <li>{{$this_error[0]}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif 
        </div>
      <div class="card">
         <div class="card-header">
            <div class="card-title">Data Peminjaman Barang</div>
         </div>
         <div class="card-body">
            <div class="col-md-3 pull-right">
                 <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                     <select id="statusss" class="form-control">
                         <option value="">- Pilih Status -</option>
                            <option value="0">Sedang Diproses</option>
                            <option value="1">Sedang Dipinjam</option>
                            <option value="2">Proses Pengembalian</option>
                            <option value="3">Selesai</option>
                            <option value="4">Tidak Disetujui</option>
                     </select>
                 </div>
            </div>
            <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
            <div class="table-responsive">
               <table id="example2" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 20%">Barang</th>
                        <th style="width: 10%">Lama Pinjam</th>
                        <th style="width: 10%">Tanggal Peminjaman</th>
                        <th style="width: 12%">Verifikasi WD</th>
                        <th style="width: 12%">Verifikasi OP</th>
                        <th style="width: 12%">Status</th>
                        <th style="width: 10%">
                           <center>Aksi</center>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('dosen.laporan.peminjamanbarang.hapus')}}">
   @csrf
   <input type="hidden" name="id" id="idhapus" value="">
</form>

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-search fa-lg fa-fw"></i> Detail Peminjaman Barang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="panel panel-primary">
                            <table class="table detail-table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td id="nama"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td id="j_kel"></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td id="no_telp"></td>
                                    </tr>
                                    <tr>
                                        <td>Lama Peminjaman</td>
                                        <td id="lama_pinjam"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Peminjaman</td>
                                        <td id="tgl_transaksi"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengembalian</td>
                                        <td id="tgl_kembali"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi Wakil Dekan</td>
                                        <td id="status_wd"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi Operator</td>
                                        <td id="status_op"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status_pj"></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td id="catatans"></td>
                                    </tr>
                                    <tr>
                                        <td>Barang</td>
                                        <td id="items"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pengembalian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pengembalian Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('dosen.laporan.peminjamanbarang.pengembalian')}}" enctype="multipart/form-data" validate>
                  @csrf
                    <div class="form-group">
                     <label>Nama</label>
                        <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                        <input type="hidden" name="iduser" id="iddosen"/>
                        <input type="hidden" name="idtransaksi" id="idtransaksi"/>
                        <input type="text" class="form-control" name="nama" readonly id="namadosen">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="j_kel" id="j_kelx" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telpx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Lama Peminjaman</label>
                        <input type="text" class="form-control" name="lama_pinjam" id="lama_pinjamx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksix" readonly>
                    </div>
                    <div class="form-group">
                        <label>Barang</label>
                        <div id="barangsx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan_kmbl" id="catatanx" placeholder="Tambahkan Catatan (Opsional)"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Kembalikan</button>
                <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
                </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
   $("#lappeminjamanbarang").addClass("active");

   $(document).ready(function () {

      $(document).on("click", ".pengembalian", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("dosen.laporan.peminjamanbarang.detail", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                  $("#namadosen").val(data.dosen.nama);
                  $("#iddosen").val(data.dosen.id);
                  $("#nimx").val(data.dosen.nim);
                  $("#j_kelx").val(data.dosen.j_kel);
                  $("#no_telpx").val(data.dosen.no_telp);
                  $("#jurusanx").val(data.dosen.jurusan);
                  $("#idtransaksi").val(data.transaksi.id);
                  $("#lama_pinjamx").val(data.transaksi.lama_pinjam);
                  $("#tgl_transaksix").val(data.transaksi.tgl_transaksi);
                  $("#ktm").attr("src", '../../'+data.dosen.ktm);
                  $(".itemsx").remove();
                  for (i = 0; i < data.items.length; i++) {
                     $("#barangsx").append(
                        '<input type="text" class="form-control itemsx" name="items" readonly value="'+data.items[i]+'" style="margin-bottom:3px;">');
                  }
              },
              error: function() { 
                   console.log(data);
              }
          });
        });

      $(document).on("click", ".detail", function (e) {
        var id = $(this).data("id");
        var url = '{{ route("dosen.laporan.peminjamanbarang.detail", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({
            type: 'GET',
            url: url,
            success: function (datax) {
               console.log(datax);
                $("#nama").text(': '+datax.dosen.nama);
                $("#j_kel").text(': '+datax.dosen.j_kel);
                $("#no_telp").text(': '+datax.dosen.no_telp);
                $("#tgl_transaksi").text(': '+datax.transaksi.tgl_transaksi);
                $("#tgl_kembali").text(': '+datax.transaksi.tgl_kembali);
                $("#lama_pinjam").text(': '+datax.transaksi.lama_pinjam);
                $("#status_wd").text(': '+datax.transaksi.status_wd);
                $("#status_op").text(': '+datax.transaksi.status_op);
                $("#status_pj").text(': '+datax.transaksi.status_pj);
                $("#catatans").text(': '+datax.transaksi.catatan);
                $("#items").text(': '+datax.items);
            },
            error: function() { 
                 console.log(data);
            }
        });
      });
   });

   $(function() {
       clearSession();
        var table = $('#example2').DataTable({
           processing: true,
           serverSide: true,
           searching : true,
           paging : true,
           lengthChange : true,
           ordering : true,
           info : true,
           "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
           "oLanguage": {
                   "sSearch": "Cari pada semua kolom : &nbsp;",
                   "sInfoFiltered": " - filter dari total _MAX_ data",
                   "sLengthMenu": "Tampilkan : _MENU_ Data",
                   "sInfo": "Ditampilkan (_START_ sampai _END_) dari _TOTAL_ Data",
                   "sZeroRecords": "Maaf, Data tidak ditemukan / tidak tersedia.",
                   "sInfoEmpty": 'Tidak ada Data yg dapat ditampilkan',
                   "sEmptyTable": "Tidak ada Data yg dapat ditampilkan"
           },
           ajax: {
           url: '{!! route('dosen.laporan.peminjamanbarang.data') !!}',
             data: function (d) {
                 d.statusss = sessionStorage.statusss;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'barang', name : 'barang'},
               { data : 'lama_pinjam', name : 'lama_pinjam'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_wd', name : 'status_wd'},
               { data : 'status_op', name : 'status_op'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
       });

       function clearSession()
       {
           sessionStorage.removeItem('statusss');
       }

       $('#statusss').on('change', function (e) {
           sessionStorage.setItem('statusss', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });

   });
</script>
@endsection