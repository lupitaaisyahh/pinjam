@extends('layouts.app')
@section('title', 'Kelola Data Peminjaman Barang')
@section('content')
<div class="content">
    <div class="panel-header bg-secondary-gradient">
        <div class="page-inner py-45">
            <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
                <div class="page-header text-white">
                    <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Kelola Data</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="#" class="text-white"></a>Kelola</li>
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
                <div class="card-title">Data Peminjaman Barang Dosen</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Nama</th>
                                <th style="width: 20%">Barang</th>
                                <th style="width: 10%">Tanggal</th>
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

        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Peminjaman Barang Mahasiswa</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Nama</th>
                                <th style="width: 10%">NIM</th>
                                <th style="width: 20%">Barang</th>
                                <th style="width: 10%">Tanggal</th>
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

<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('wakildekan.keloladata.peminjamanbarang.hapus')}}">
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
                                        <td>NIM</td>
                                        <td id="nim"></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td id="jurusan"></td>
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

<div class="modal fade" id="details" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-search fa-lg fa-fw"></i> Detail Peminjaman Barang Dosen</h3>
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
                                        <td id="namas"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td id="j_kels"></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td id="no_telps"></td>
                                    </tr>
                                    <tr>
                                        <td>Lama Peminjaman</td>
                                        <td id="lama_pinjams"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Peminjaman</td>
                                        <td id="tgl_transaksis"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengembalian</td>
                                        <td id="tgl_kembalis"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi Wakil Dekan</td>
                                        <td id="status_wds"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi Operator</td>
                                        <td id="status_ops"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status_pjs"></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td id="catatanss"></td>
                                    </tr>
                                    <tr>
                                        <td>Barang</td>
                                        <td id="itemss"></td>
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

<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('wakildekan.keloladata.peminjamanbarang.verifikasi')}}" enctype="multipart/form-data" validate>
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                        <input type="hidden" name="iduser" id="idmahasiswa"/>
                        <input type="hidden" name="idtransaksi" id="idtransaksi"/>
                        <input type="text" class="form-control" name="nama" readonly id="namamahasiswa">
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" id="nimx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" id="jurusanx" readonly>
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
                        <label>KTM</label>
                        <img id="ktm" alt="Gambar KTM" width="220px" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Lama Peminjaman</label>
                        <input type="text" class="form-control" name="lama_pinjamxs" id="lama_pinjamxs" readonly>
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
                        <textarea class="form-control" name="catatan" id="catatanx" readonly placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Verifikasi</label>
                        <input type="text" class="form-control" name="tgl_verifikasi_wd" readonly value="{{date('d-m-Y | H:i', time())}}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="statusx">
                            <option value="1">Terverifikasi</option>
                            <option value="2">Tidak Terverifikasi</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary font-weight-bold">Oke</button>
            <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="verifikasis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman Barang Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('wakildekan.keloladata.peminjamanbarang.verifikasis')}}" enctype="multipart/form-data" validate>
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                        <input type="hidden" name="iduser" id="iddosenx"/>
                        <input type="hidden" name="idtransaksi" id="idtransaksix"/>
                        <input type="text" class="form-control" name="nama" readonly id="namamahasiswax">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="j_kel" id="j_kelxx" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telpxx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Lama Peminjaman</label>
                        <input type="text" class="form-control" name="lama_pinjamxs" id="lama_pinjamxsx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksixx" readonly>
                    </div>
                    <div class="form-group">
                        <label>Barang</label>
                        <div id="barangsxx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatanxx" readonly placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Verifikasi</label>
                        <input type="text" class="form-control" name="tgl_verifikasi_wd" readonly value="{{date('d-m-Y | H:i', time())}}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="statusxx">
                            <option value="1">Terverifikasi</option>
                            <option value="2">Tidak Terverifikasi</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary font-weight-bold">Ok</button>
            <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $("#peminjamanbarang").addClass("active");
    
    $(document).ready(function () {
        $(document).on("click", ".verifikasi", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("wakildekan.keloladata.peminjamanbarang.detail", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                  $("#namamahasiswa").val(data.mahasiswa.nama);
                  $("#idmahasiswa").val(data.mahasiswa.id);
                  $("#nimx").val(data.mahasiswa.nim);
                  $("#j_kelx").val(data.mahasiswa.j_kel);
                  $("#no_telpx").val(data.mahasiswa.no_telp);
                  $("#jurusanx").val(data.mahasiswa.jurusan);
                  $("#idtransaksi").val(data.transaksi.id);
                  $("#lama_pinjamxs").val(data.transaksi.lama_pinjam);
                  $("#tgl_transaksix").val(data.transaksi.tgl_transaksi);
                  $("#catatanx").val(data.transaksi.catatan);
                  $("#ktm").attr("src", '../../'+data.mahasiswa.ktm);
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
            var url = '{{ route("wakildekan.keloladata.peminjamanbarang.detail", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (datax) {
                   console.log(datax);
                    $("#nama").text(': '+datax.mahasiswa.nama);
                    $("#nim").text(': '+datax.mahasiswa.nim);
                    $("#jurusan").text(': '+datax.mahasiswa.jurusan);
                    $("#j_kel").text(': '+datax.mahasiswa.j_kel);
                    $("#no_telp").text(': '+datax.mahasiswa.no_telp);
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

        // Dosen
        $(document).on("click", ".verifikasis", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("wakildekan.keloladata.peminjamanbarang.details", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                  $("#namamahasiswax").val(data.dosen.nama);
                  $("#iddosenx").val(data.dosen.id);
                  $("#j_kelxx").val(data.dosen.j_kel);
                  $("#no_telpxx").val(data.dosen.no_telp);
                  $("#jurusanxx").val(data.dosen.jurusan);
                  $("#idtransaksix").val(data.transaksi.id);
                  $("#lama_pinjamxsx").val(data.transaksi.lama_pinjam);
                  $("#tgl_transaksixx").val(data.transaksi.tgl_transaksi);
                  $("#catatanxx").val(data.transaksi.catatan);
                  $(".itemsx").remove();
                  for (i = 0; i < data.items.length; i++) {
                     $("#barangsxx").append(
                        '<input type="text" class="form-control itemsx" name="items" readonly value="'+data.items[i]+'" style="margin-bottom:3px;">');
                  }
              },
              error: function() { 
                   console.log(data);
              }
          });
        });
    
        $(document).on("click", ".details", function (e) {
            var id = $(this).data("id");
            var url = '{{ route("wakildekan.keloladata.peminjamanbarang.details", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (datax) {
                   console.log(datax);
                    $("#namas").text(': '+datax.dosen.nama);
                    $("#j_kels").text(': '+datax.dosen.j_kel);
                    $("#no_telps").text(': '+datax.dosen.no_telp);
                    $("#tgl_transaksis").text(': '+datax.transaksi.tgl_transaksi);
                    $("#tgl_kembalis").text(': '+datax.transaksi.tgl_kembali);
                    $("#lama_pinjams").text(': '+datax.transaksi.lama_pinjam);
                    $("#status_wds").text(': '+datax.transaksi.status_wd);
                    $("#status_ops").text(': '+datax.transaksi.status_op);
                    $("#status_pjs").text(': '+datax.transaksi.status_pj);
                    $("#catatanss").text(': '+datax.transaksi.catatan);
                    $("#itemss").text(': '+datax.items);
                },
                error: function() { 
                     console.log(data);
                }
            });
        });
    });
    
    $(function() {
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
           url: '{!! route('wakildekan.keloladata.peminjamanbarang.data') !!}',
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'mahasiswa', name : 'mahasiswa'},
               { data : 'nim', name : 'nim'},
               { data : 'barang', name : 'barang'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_wd', name : 'status_op'},
               { data : 'status_op', name : 'status_op'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
        });

        var tables = $('#example3').DataTable({
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
           url: '{!! route('wakildekan.keloladata.peminjamanbarang.datas') !!}',
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'nama', name : 'nama'},
               { data : 'barang', name : 'barang'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_wd', name : 'status_op'},
               { data : 'status_op', name : 'status_op'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
    });
</script>
@endsection