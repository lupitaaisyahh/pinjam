@extends('layouts.app')
@section('title', 'Kelola Data Pengembalian Ruangan')
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
                        <li class="nav-item"><a>Pengembalian Ruangan</a></li>
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
                <div class="card-title">Data Pengembalian Ruangan Dosen</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example22" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 15%">Nama</th>
                                <th style="width: 10%">Gedung</th>
                                <th style="width: 10%">Ruangan</th>
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
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Pengembalian Ruangan Mahasiswa</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Nama</th>
                                <th style="width: 10%">Gedung</th>
                                <th style="width: 10%">Ruangan</th>
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

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-search fa-lg fa-fw"></i> Detail Peminjaman Ruangan</h3>
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
                                        <td>Tanggal Transaksi</td>
                                        <td id="tgl_transaksi"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kembali</td>
                                        <td id="tgl_kembali"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status_pj"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi WD</td>
                                        <td id="status_wd"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi OP</td>
                                        <td id="status_op"></td>
                                    </tr>
                                    <tr>
                                        <td>Gedung</td>
                                        <td id="gedungx"></td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan</td>
                                        <td id="ruanganx"></td>
                                    </tr>
                                    <tr>
                                        <td>Lama Pinjam</td>
                                        <td id="jumlah_harix"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center>
                                                <img id="gambar" alt="Foto Ruangan" width="300px" height="250px">
                                            </center>
                                        </td>
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
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('admin.keloladata.pengembalianruangan.verifikasi')}}" enctype="multipart/form-data" validate>
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
                        <label>Gedung</label>
                        <input type="text" class="form-control" name="gedungs" id="gedungs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ruangan</label>
                        <input type="text" class="form-control" name="ruangans" id="ruangans" readonly>
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
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatanx" readonly placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto Ruangan</label>
                        <img id="foto_ruang" alt="Foto Ruangan" width="220px" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Tanggal Verifikasi</label>
                        <input type="text" class="form-control" name="tgl_verifikasi_op" readonly value="{{date('d-m-Y | H:i', time())}}">
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
            <button type="submit" class="btn btn-primary font-weight-bold">Ok</button>
            <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Dosen -->

<div class="modal fade" id="details" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-search fa-lg fa-fw"></i> Detail Peminjaman Ruangan</h3>
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
                                        <td>Tanggal Transaksi</td>
                                        <td id="tgl_transaksis"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kembali</td>
                                        <td id="tgl_kembalis"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status_pjs"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi WD</td>
                                        <td id="status_wds"></td>
                                    </tr>
                                    <tr>
                                        <td>Verifikasi OP</td>
                                        <td id="status_ops"></td>
                                    </tr>
                                    <tr>
                                        <td>Gedung</td>
                                        <td id="gedungxs"></td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan</td>
                                        <td id="ruanganxs"></td>
                                    </tr>
                                    <tr>
                                        <td>Lama Pinjam</td>
                                        <td id="jumlah_harixs"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center>
                                                <img id="gambars" alt="Foto Ruangan" width="300px" height="250px">
                                            </center>
                                        </td>
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
<div class="modal fade" id="verifikasis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('admin.keloladata.pengembalianruangan.verifikasis')}}" enctype="multipart/form-data" validate>
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                        <input type="hidden" name="iduser" id="iddosen"/>
                        <input type="hidden" name="idtransaksi" id="idtransaksis"/>
                        <input type="text" class="form-control" name="nama" readonly id="namadosen">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="j_kel" id="j_kelxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telpxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gedung</label>
                        <input type="text" class="form-control" name="gedungs" id="gedungss" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ruangan</label>
                        <input type="text" class="form-control" name="ruangans" id="ruanganss" readonly>
                    </div>
                    <div class="form-group">
                        <label>Lama Peminjaman</label>
                        <input type="text" class="form-control" name="lama_pinjamxs" id="lama_pinjamxss" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksixs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatanxs" readonly placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto Ruangan</label>
                        <img id="foto_ruangs" alt="Foto Ruangan" width="220px" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Tanggal Verifikasi</label>
                        <input type="text" class="form-control" name="tgl_verifikasi_op" readonly value="{{date('d-m-Y | H:i', time())}}">
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
    $("#pengembalianruangan").addClass("active");
    
    $(document).ready(function () {
        $(document).on("click", ".verifikasi", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("admin.keloladata.pengembalianruangan.detail", ":id") }}';
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
                  $("#lama_pinjamxs").val(data.transaksi.jumlah_hari);
                  $("#gedungs").val(data.transaksi.gedung);
                  $("#ruangans").val(data.transaksi.ruangans);
                  $("#tgl_transaksix").val(data.transaksi.tgl_transaksi);
                  $("#catatanx").val(data.transaksi.catatan);
                  $("#ktm").attr("src", '../../'+data.mahasiswa.ktm);
                  $("#foto_ruang").attr("src", '../../'+data.transaksi.foto);
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
            var url = '{{ route("admin.keloladata.pengembalianruangan.detail", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                   console.log(data);
                    $("#nama").text(': '+data.mahasiswa.nama);
                    $("#nim").text(': '+data.mahasiswa.nim);
                    $("#jurusan").text(': '+data.mahasiswa.jurusan);
                    $("#tgl_transaksi").text(': '+data.transaksi.tgl_transaksi);
                    $("#tgl_kembali").text(': '+data.transaksi.tgl_kembali);
                    $("#status_pj").text(': '+data.transaksi.status_pj);
                    $("#status_wd").text(': '+data.transaksi.status_wd);
                    $("#status_op").text(': '+data.transaksi.status_op);
                    $("#gedungx").text(': '+data.transaksi.gedung);
                    $("#ruanganx").text(': '+data.transaksi.ruangans);
                    $("#jumlah_harix").text(': '+data.transaksi.jumlah_hari);
                    $("#gambar").attr("src", '../../'+data.transaksi.foto);
                },
                error: function() { 
                     console.log(data);
                }
            });
        });

        // Dosen
        $(document).on("click", ".verifikasis", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("admin.keloladata.pengembalianruangan.details", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                  $("#namadosen").val(data.dosen.nama);
                  $("#iddosen").val(data.dosen.id);
                  $("#j_kelxs").val(data.dosen.j_kel);
                  $("#no_telpxs").val(data.dosen.no_telp);
                  $("#idtransaksis").val(data.transaksi.id);
                  $("#lama_pinjamxss").val(data.transaksi.jumlah_hari);
                  $("#gedungss").val(data.transaksi.gedung);
                  $("#ruanganss").val(data.transaksi.ruangans);
                  $("#tgl_transaksixs").val(data.transaksi.tgl_transaksi);
                  $("#catatanxs").val(data.transaksi.catatan);
                  $("#foto_ruangs").attr("src", '../../'+data.transaksi.foto);
              },
              error: function() { 
                   console.log(data);
              }
          });
        });
    
        $(document).on("click", ".details", function (e) {
            var id = $(this).data("id");
            var url = '{{ route("admin.keloladata.pengembalianruangan.details", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                   console.log(data);
                    $("#namas").text(': '+data.dosen.nama);
                    $("#tgl_transaksis").text(': '+data.transaksi.tgl_transaksi);
                    $("#tgl_kembalis").text(': '+data.transaksi.tgl_kembali);
                    $("#status_pjs").text(': '+data.transaksi.status_pj);
                    $("#status_wds").text(': '+data.transaksi.status_wd);
                    $("#status_ops").text(': '+data.transaksi.status_op);
                    $("#gedungxs").text(': '+data.transaksi.gedung);
                    $("#ruanganxs").text(': '+data.transaksi.ruangans);
                    $("#jumlah_harixs").text(': '+data.transaksi.jumlah_hari);
                    $("#gambars").attr("src", '../../'+data.transaksi.foto);
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
           url: '{!! route('admin.keloladata.pengembalianruangan.data') !!}',
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'nama', name : 'nama'},
               { data : 'gedung', name : 'gedung'},
               { data : 'ruangan', name : 'ruangan'},
               { data : 'jumlah_hari', name : 'jumlah_hari'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_wd', name : 'status_wd'},
               { data : 'status_op', name : 'status_op'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
    });
    
    $(function() {
        var table = $('#example22').DataTable({
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
           url: '{!! route('admin.keloladata.pengembalianruangan.datas') !!}',
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'nama', name : 'nama'},
               { data : 'gedung', name : 'gedung'},
               { data : 'ruangan', name : 'ruangan'},
               { data : 'jumlah_hari', name : 'jumlah_hari'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_wd', name : 'status_wd'},
               { data : 'status_op', name : 'status_op'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
    });
</script>
@endsection