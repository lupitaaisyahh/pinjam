@extends('layouts.app')
@section('title', 'Master Data Gedung')
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-building mr-2"></i> Gedung</h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">Gedung</a></li>
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
            <div class="card-title">Data Gedung</div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="example2" class="display table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 30%">Gedung</th>
                        <th style="width: 5%">
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
<form method="post" enctype="multipart/form-data" class="form-horizontal" id="formhapus" action="{{ route('admin.master.gedung.hapus')}}">
   @csrf
   <input type="hidden" name="id" id="idhapus" value="">
</form>
<div class="modal fade" id="tambah">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <form method="POST" action="{{ route('admin.master.gedung.tambah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <label>Gedung</label>
                  <input type="text" name="gedung" class="form-control" placeholder="Masukkan Data Gedung" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
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
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Ubah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span  aria-hidden="true">&times;</span></button>
         </div>
         <form method="POST" action="{{ route('admin.master.gedung.ubah')}}" enctype="multipart/form-data" validate>
            <div class="modal-body">
               @csrf
               <div class="form-group">
                  <label>Gedung</label>
                  <input type="hidden" name="id" id="id">
                  <input type="text" name="gedung" id="gedungs" class="form-control" placeholder="Masukkan Data Gedung" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
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
   $("#datagedung").addClass("active");
   
   $(function() {
       $('#example2').DataTable({
           processing: true,
           serverSide: true,
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
           url: '{!! route('admin.master.gedung.data') !!}',
             data: function (d) {
                 d.type = sessionStorage.type;
             }
           },
           columns: [
               { data : 'DT_RowIndex', name : 'id' },
               { data : 'gedung', name : 'gedung'},
               { data : 'aksi', name : 'aksi'},
           ]
       });
   });
   
   $('#edit').on('show.bs.modal', function(event){
       var row = $(event.relatedTarget);
       var id = row.data('id');
       var gedung =  row.data('gedung');
       $('#id').val(id);
       $('#gedungs').val(gedung);
   });
</script>
@endsection