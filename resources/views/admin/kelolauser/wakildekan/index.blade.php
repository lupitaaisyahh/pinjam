@extends('layouts.app')
@section('title', 'Manajemen User Wakil Dekan')
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-users mr-2"></i> User Wakil Dekan</h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">User Wakil Dekan</a></li>
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
            <div class="card-title">User Wakil Dekan</div>
         </div>
         <div class="card-body">
            <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
            <div class="table-responsive">
               <table id="example2" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                         <th style="width: 1%">No</th>
                         <th style="width: 20%">Nama</th>
                         <th style="width: 15%">Username</th>
                         <th>Jenis Kelamin</th>
                         <th style="width: 10%">No Telp</th>
                         <th style="width: 10%">Chat ID</th>
                         <th style="width: 15%">Last Login</th>
                         <th style="width: 10%"><center>Aksi</center></th>
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
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('admin.kelolauser.wakildekan.hapus')}}">
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
         <form method="POST" action="{{ route('admin.kelolauser.wakildekan.tambah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <label>Nama Wakil Dekan</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Wakil Dekan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select name="j_kel" class="form-control" required>
                     <option value="Laki-laki">Laki-laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
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
                   <label>Username</label>
                   <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
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
         <form method="POST" action="{{ route('admin.kelolauser.wakildekan.ubah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <label>Nama Wakil Dekan</label>
                  <input type="text" name="nama" id="namas" class="form-control" placeholder="Masukkan Nama Wakil Dekan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select name="j_kel" id="j_kels" class="form-control" required>
                     <option value="Laki-laki">Laki-laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
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
                   <label>Username</label>
                   <input type="text" name="username" id="usernames" class="form-control" placeholder="Masukkan Username" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
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
@endsection
@section('js')
<script>
   $("#manajemenuser").addClass("active");
   $("#pengguna").addClass("show");
   $("#datawakildekan").addClass("active");

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
           url: '{!! route('admin.kelolauser.wakildekan.data') !!}',
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
                { data : 'chat_id', name : 'chat_id'},
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
       var email =  row.data('email');
       var username =  row.data('username');
       var j_kel =  row.data('j_kel');
       var no_telp =  row.data('no_telp');
       var chat_id =  row.data('chat_id');
       $('#id').val(id);
       $('#namas').val(nama);
       $('#emails').val(email);
       $('#usernames').val(username);
       $('#j_kels').val(j_kel);
       $('#no_telps').val(no_telp);
       $('#chat_ids').val(chat_id);
   });
</script>
@endsection