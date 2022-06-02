@extends('layouts.app')
@section('title', 'Laporan Data Peminjaman Ruangan')
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
            <div class="ml-md-auto py-2 py-md-0">
               <a href="" class="btn btn-secondary btn-round mr-2 tombolinput" data-toggle="modal" data-target="#tambah">
                   <span class="btn-label"><i class="fa fa-plus mr-2"></i></span> Entri Data
               </a>
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
            <div class="card-title">Data Ruangan</div>
         </div>
         <div class="card-body">
            <div class="col-md-3 pull-right">
                 <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                     <select id="gedungxx" class="form-control">
                         <option value="">- Pilih Gedung -</option>
                         @foreach($gedung as $gedungs)
                            <option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
                         @endforeach
                     </select>
                 </div>
            </div>
            <div class="col-md-3 pull-right">
                 <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                     <select id="statusx" class="form-control">
                         <option value="">- Pilih Status -</option>
                            <option value="1">Sedang Dipinjam</option>
                            <option value="0">Tersedia</option>
                     </select>
                 </div>
            </div>
                
            <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
            <div class="table-responsive">
               <table id="example3" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 20%">Gedung</th>
                        <th style="width: 20%">Ruangan</th>
                        <th style="width: 25%">Foto</th>
                        <th style="width: 10%">Status Ruangan</th>
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
            <div class="card-title">Data Peminjaman Ruangan</div>
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
                        <th style="width: 15%">Gedung</th>
                        <th style="width: 12%">Ruangan</th>
                        <th style="width: 10%">Lama Pinjam</th>
                        <th style="width: 12%">Tanggal Peminjaman</th>
                        <th style="width: 10%">Verifikasi WD</th>
                        <th style="width: 10%">Verifikasi OP</th>
                        <th style="width: 10%">Status</th>
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
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('wakildekan.laporan.peminjamanruangan.hapus')}}">
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
                                        <td>Tanggal Transaksi</td>
                                        <td id="tgl_transaksi"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status"></td>
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
                                        <td>Jumlah Hari</td>
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


@endsection
@section('js')
<script>
   $("#lappeminjamanruanganwd").addClass("active");

   $(document).ready(function () {
        $(document).on("click", ".verifikasi", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("wakildekan.laporan.peminjamanruangan.detail", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                  $("#namamahasiswa").val(data.mahasiswa.nama);
                  $("#idmahasiswa").val(data.mahasiswa.id);
                  $("#nimx").val(data.mahasiswa.nim);
                  $("#jurusanx").val(data.mahasiswa.jurusan);
                  $("#idtransaksi").val(data.transaksi.id);
                  $("#tgl_transaksix").val(data.transaksi.tgl_transaksi);
                  $("#gedungxs").val(data.transaksi.gedung);
                  $("#ruanganxs").val(data.transaksi.ruangans);
                  $("#jumlah_harixs").val(data.transaksi.jumlah_hari);
              },
              error: function() { 
                   console.log(data);
              }
          });
        });

        $(document).on("click", ".detail", function (e) {
            var id = $(this).data("id");
            var url = '{{ route("wakildekan.laporan.peminjamanruangan.detail", ":id") }}';
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
                    $("#status").text(': '+data.transaksi.status);
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
           url: '{!! route('wakildekan.laporan.peminjamanruangan.datas') !!}',
             data: function (d) {
                 d.gedungxx = sessionStorage.gedungxx;
                 d.statusx = sessionStorage.statusx;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'gedung', name : 'gedung'},
               { data : 'nama', name : 'nama'},
               { data : 'foto', name : 'foto'},
               { data : 'status_pj', name : 'status_pj'},
           ]
       });

       function clearSession()
       {
           sessionStorage.removeItem('gedungxx');
           sessionStorage.removeItem('statusx');
       }

       $('#gedungxx').on('change', function (e) {
           sessionStorage.setItem('gedungxx', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });

       $('#statusx').on('change', function (e) {
           sessionStorage.setItem('statusx', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
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
           url: '{!! route('wakildekan.laporan.peminjamanruangan.data') !!}',
             data: function (d) {
                 d.statusss = sessionStorage.statusss;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
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