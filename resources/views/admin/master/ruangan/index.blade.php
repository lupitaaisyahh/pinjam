@extends('layouts.app')
@section('title', 'Master Data Ruangan')
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-building mr-2"></i> Ruangan</h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">Ruangan</a></li>
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
                
            <div class="driver" style="margin-top: 2.5em;color:#ffffff;">.</div>
            <div class="table-responsive">
               <table id="example2" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 20%">Gedung</th>
                        <th style="width: 20%">Ruangan</th>
                        <th style="width: 25%">Foto</th>
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
</div>
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('admin.master.ruangan.hapus')}}">
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
         <form method="POST" action="{{ route('admin.master.ruangan.tambah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <label>Nama Ruangan</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Ruangan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Gedung</label>
                  <select name="gedung_id" class="form-control" required>
                     @foreach($gedung as $gedungs)
                        <option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" required>
                     <option value="Aktif">Aktif</option>
                     <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Keterangan (Opsional)</label>
                  <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
               </div>
               <div class="form-group">
                   <label>Gambar <code style="color:red !important;"><small><i>Required</i></small></code></label>
                   <input type="file" required name="foto" accept=".jpg,.jpeg,.png,.gif" class="filestyle form-control" data-buttonbefore="true" data-buttontext="Pilih File"  id="profile-img" tabindex="-1">
               </div>
               <div class="form-group">
                   <img src="" id="profile-img-tag" width="220px" />
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
         <form method="POST" action="{{ route('admin.master.ruangan.ubah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <label>Nama Ruangan</label>
                  <input type="text" name="nama" id="namas" class="form-control" placeholder="Masukkan Nama Ruangan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
               </div>
               <div class="form-group">
                  <label>Gedung</label>
                  <select name="gedung_id" id="gedung_ids" class="form-control" required>
                     @foreach($gedung as $gedungs)
                        <option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select name="status" id="statuss" class="form-control" required>
                     <option value="Aktif">Aktif</option>
                     <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Keterangan (Opsional)</label>
                  <textarea name="keterangan" id="keterangans" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
               </div>
               <div class="form-group">
                   <label>Gambar <code style="color:red !important;"><small><i>Required</i></small></code></label>
                   <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif" class="filestyle form-control" data-buttonbefore="true" data-buttontext="Pilih File"  id="profile-imgs">
               </div>
               <div class="form-group">
                   <img src="" id="profile-img-tags" width="220px" />
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
   $("#mastergedung").addClass("active");
   $("#gedung").addClass("show");
   $("#dataruangan").addClass("active");
   
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });

    function readURs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tags').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-imgs").change(function(){
        readURLs(this);
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
           url: '{!! route('admin.master.ruangan.data') !!}',
             data: function (d) {
                 d.gedungxx = sessionStorage.gedungxx;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'gedung', name : 'gedung'},
               { data : 'nama', name : 'nama'},
               { data : 'foto', name : 'foto'},
               { data : 'status', name : 'status'},
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
       var gedung_id =  row.data('gedung_id');
       var status =  row.data('status');
       var keterangan =  row.data('keterangan');
       var foto =  row.data('foto');
       $('#id').val(id);
       $('#namas').val(nama);
       $('#statuss').val(status);
       $('#keterangans').val(keterangan);
       $("#profile-img-tags").attr("src", '../../'+foto);
       $('#gedung_ids').val(gedung_id);
   });
</script>
@endsection