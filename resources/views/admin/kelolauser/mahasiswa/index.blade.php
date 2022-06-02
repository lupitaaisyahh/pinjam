@extends('layouts.app')
@section('title', 'Manajemen User Mahasiswa')
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-users mr-2"></i> User Mahasiswa</h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">User Mahasiswa</a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a>Data</a></li>
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
            <div class="card-title">User Mahasiswa</div>
         </div>
         <div class="card-body">
            <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
            <div class="table-responsive">
               <table id="example2" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                         <th style="width: 1%">No</th>
                         <th style="width: 15%">Nama</th>
                         <th style="width: 12%">Username</th>
                         <th style="width: 10%">Jenis Kelamin</th>
                         <th style="width: 15%">No Telp</th>
                         <th style="width: 13%">Status</th>
                         <th style="width: 15%">Last Login</th>
                         <th style="width: 12%"><center>Aksi</center></th>
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
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('admin.kelolauser.mahasiswa.hapus')}}">
   @csrf
   <input type="hidden" name="id" id="idhapus" value="">
</form>
<div class="modal fade" id="tambah">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <form method="POST" action="{{ route('admin.kelolauser.mahasiswa.tambah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <label>Nama Mahasiswa</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>NIM</label>
                  <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Mahasiswa" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select name="j_kel" class="form-control" required>
                     <option value="Laki-laki">Laki-laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Jurusan</label>
                  <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>E-Mail</label>
                   <input type="email" name="email" class="form-control" placeholder="Masukkan E-Mail " required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>No Telepon</label>
                   <input type="number" min="0" name="no_telp" class="form-control" placeholder="Masukkan No Telepon" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>Chat ID</label>
                   <input type="text" name="chat_id" class="form-control" placeholder="Masukkan Chat ID" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>Password</label>
                   <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Simpan</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="edit">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Ubah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span  aria-hidden="true">&times;</span></button>
         </div>
         <form method="POST" action="{{ route('admin.kelolauser.mahasiswa.ubah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <label>Nama Mahasiswa</label>
                  <input type="text" name="nama" id="namas" class="form-control" placeholder="Masukkan Nama Mahasiswa" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>NIM</label>
                  <input type="text" name="nim" id="nims" class="form-control" placeholder="Masukkan NIM Mahasiswa" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select name="j_kel" id="j_kels" class="form-control" required>
                     <option value="Laki-laki">Laki-laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Jurusan</label>
                  <input type="text" name="jurusan" id="jurusans" class="form-control" placeholder="Masukkan Jurusan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>E-Mail</label>
                   <input type="email" name="email" id="emails" class="form-control" placeholder="Masukkan E-Mail " required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>No Telepon</label>
                   <input type="number" min="0" name="no_telp" id="no_telps" class="form-control" placeholder="Masukkan No Telepon" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>Chat ID</label>
                   <input type="text" name="chat_id" id="chat_ids" class="form-control" placeholder="Masukkan Chat ID" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                   <label>Password (Opsional)</label>
                   <input type="password" name="password" class="form-control" placeholder="Masukkan Password" oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Simpan</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-search fa-lg fa-fw"></i> Detail Data Mahasiswa</h3>
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
                                        <td>E-Mail</td>
                                        <td id="email"></td>
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
                                        <td>KTM</td>
                                        <td><img id="ktm" alt="Gambar KTM" width="220px"></td>
                                    </tr>
                                    <tr>
                                        <td>Chat ID</td>
                                        <td id="chat_id"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="status"></td>
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
                <form id="formAdd" method="POST" action="{{ route('admin.kelolauser.mahasiswa.verifikasi')}}" enctype="multipart/form-data" validate>
                  @csrf
                    <div class="form-group">
                     <label>Nama</label>
                        <input type="hidden" class="form-control" name="id" id="mahasiswaidx">
                        <input type="text" class="form-control" name="nama" readonly id="namaxs">
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" id="nimxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" id="jurusanxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="j_kel" id="j_kelxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no_telpxs" id="no_telpxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>Chat ID</label>
                        <input type="text" class="form-control" name="chat_idxs" id="chat_idxs" readonly>
                    </div>
                    <div class="form-group">
                        <label>KTM</label>
                        <img id="ktmxs" alt="Gambar KTM" height="80px" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="statusxs" id="statusxs" readonly>
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
                <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
                </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
   $("#manajemenuser").addClass("active");
   $("#pengguna").addClass("show");
   $("#datamahasiswa").addClass("active");

   $(document).ready(function () {
        $(document).on("click", ".verifikasi", function (e) {
          var id = $(this).data("id");
          var url = '{{ route("admin.kelolauser.mahasiswa.detail", ":id") }}';
          url = url.replace(':id', id);
          $.ajax({
              type: 'GET',
              url: url,
              success: function (data) {
                 console.log(data);
                    $("#mahasiswaidx").val(data.id);
                    $("#namaxs").val(data.nama);
                    $("#nimxs").val(data.nim);
                    $("#jurusanxs").val(data.jurusan);
                    $("#emailxs").val(data.email);
                    $("#j_kelxs").val(data.j_kel);
                    $("#no_telpxs").val(data.no_telp);
                    $("#chat_idxs").val(data.chat_id);
                    $("#statusxs").val(data.status);
                    $("#ktmxs").attr("src", '../../'+data.ktm);
              },
              error: function() { 
                   console.log(data);
              }
          });
        });

        $(document).on("click", ".detail", function (e) {
            var id = $(this).data("id");
            var url = '{{ route("admin.kelolauser.mahasiswa.detail", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (datax) {
                   console.log(datax);
                    $("#nama").text(': '+datax.nama);
                    $("#nim").text(': '+datax.nim);
                    $("#jurusan").text(': '+datax.jurusan);
                    $("#email").text(': '+datax.email);
                    $("#j_kel").text(': '+datax.j_kel);
                    $("#no_telp").text(': '+datax.no_telp);
                    $("#chat_id").text(': '+datax.chat_id);
                    $("#ktm").attr("src", '../../'+datax.ktm);
                    $("#status").text(': '+datax.status);
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
           url: '{!! route('admin.kelolauser.mahasiswa.data') !!}',
             data: function (d) {
                 d.gedungxx = sessionStorage.gedungxx;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
                { data : 'nama', name : 'nama'},
                { data : 'username', name : 'username'},
                { data : 'j_kel', name : 'j_kel'},
                { data : 'no_telp', name : 'no_telp'},
                { data : 'status', name : 'status'},
                { data : 'lastlogin', name : 'lastlogin'},
                { data : 'aksi', name : 'aksi'},
           ]
       });

       function clearSession()
       {
           sessionStorage.removeItem('gedungxx');
       }

       $('#gedungxx').on('change', function (e) {
           sessionStorage.setItem('gedungxx', this.value);
           console.log(this.value);
           table.draw();
           e.preventDefault();
       });

   });
   
   $('#edit').on('show.bs.modal', function(event){
       var row = $(event.relatedTarget);
       var id = row.data('id');
       var nama =  row.data('nama');
       var nim =  row.data('nim');
       var jurusan =  row.data('jurusan');
       var email =  row.data('email');
       var username =  row.data('username');
       var j_kel =  row.data('j_kel');
       var no_telp =  row.data('no_telp');
       var chat_id =  row.data('chat_id');
       $('#id').val(id);
       $('#namas').val(nama);
       $('#nims').val(nim);
       $('#jurusans').val(jurusan);
       $('#emails').val(email);
       $('#usernames').val(username);
       $('#j_kels').val(j_kel);
       $('#no_telps').val(no_telp);
       $('#chat_ids').val(chat_id);
   });
</script>
@endsection