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
                        <select id="jenisxx" class="form-control">
                            <option value="">- Pilih Jenis Barang -</option>
                            @foreach($jenis as $jeniss)
                            <option value="{{$jeniss->id}}">{{$jeniss->jenis_barang}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
                <div class="table-responsive">
                    <table id="example2" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Jenis</th>
                                <th style="width: 20%">Barang</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 10%">Stok</th>
                                <th style="width: 10%">Dipinjam</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 8%">
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
                <div class="card-title">Riwayat Peminjaman Barang Dosen</div>
            </div>
            <div class="card-body">
                <div class="col-md-3 pull-right">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                        <select id="statussss" class="form-control">
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
                    <table id="example33" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Mahasiswa</th>
                                <th style="width: 10%">Jenis Kelamin</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 10%">Tgl Transaksi</th>
                                <th style="width: 10%">Status Peminjaman</th>
                                <th style="width: 8%">
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
                <div class="card-title">Riwayat Peminjaman Barang Mahasiswa</div>
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
                    <table id="example3" class="display table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">No</th>
                                <th style="width: 10%">Mahasiswa</th>
                                <th style="width: 10%">NIM</th>
                                <th style="width: 10%">Jenis Kelamin</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 10%">Tgl Transaksi</th>
                                <th style="width: 10%">Status Peminjaman</th>
                                <th style="width: 8%">
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
@endsection
@section('js')
<script>
    $("#lappeminjamanbarang").addClass("active");
    
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
           url: '{!! route('wakildekan.laporan.peminjamanbarang.data') !!}',
             data: function (d) {
                 d.jenisxx = sessionStorage.jenisxx;
                 d.statusxx = sessionStorage.statusxx;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'jenis', name : 'jenis'},
               { data : 'nama', name : 'nama'},
               { data : 'jumlah', name : 'jumlah'},
               { data : 'jumlah_stok', name : 'jumlah_stok'},
               { data : 'dipinjam', name : 'dipinjam'},
               { data : 'status', name : 'status'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
    
       function clearSession()
       {
           sessionStorage.removeItem('jenisxx');
       }
    
       $('#jenisxx').on('change', function (e) {
           sessionStorage.setItem('jenisxx', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });
    
       $('#statusxx').on('change', function (e) {
           sessionStorage.setItem('statusxx', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });
    
    });
    
    $(function() {
       clearSession();
        var table = $('#example3').DataTable({
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
           url: '{!! route('wakildekan.laporan.peminjamanbarang.datas') !!}',
             data: function (d) {
                 d.statusss = sessionStorage.statusss;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'mahasiswa', name : 'mahasiswa'},
               { data : 'nim', name : 'nim'},
               { data : 'j_kel', name : 'j_kel'},
               { data : 'jumlah', name : 'jumlah'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
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
    
    $(function() {
       clearSession();
        var table = $('#example33').DataTable({
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
           url: '{!! route('wakildekan.laporan.peminjamanbarang.datass') !!}',
             data: function (d) {
                 d.statussss = sessionStorage.statussss;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'dosen', name : 'dosen'},
               { data : 'j_kel', name : 'j_kel'},
               { data : 'jumlah', name : 'jumlah'},
               { data : 'tgl_transaksi', name : 'tgl_transaksi'},
               { data : 'status_pj', name : 'status_pj'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
    
       function clearSession()
       {
           sessionStorage.removeItem('statussss');
       }
    
       $('#statussss').on('change', function (e) {
           sessionStorage.setItem('statussss', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });
    
    });
</script>
@endsection