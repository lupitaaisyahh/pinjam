@extends('layouts.app')
@section('title', 'Transaksi Data Ruangan')
@section('css')
<style>

    .select2-container .select2-selection--single{
        height: calc(2.25rem + 2px);
        border: 1px solid #ced4da;
        font-size: 14px;
            border-color: #ebedf2;
            padding: .4rem 1rem;
            padding-right: 1rem;
            height: inherit!important;
       border-radius: .25rem;
       border-top-left-radius: 0.25rem;
       border-top-right-radius: 0.25rem;
       border-bottom-right-radius: 0.25rem;
       border-bottom-left-radius: 0.25rem;
       transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
      color: #fff;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
      color: #fff;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
      background-color: #3c8dbc;
      border-color: #367fa9;
      padding: 1px 10px;
    }

</style>
@endsection
@section('content')
<div class="content">
   <div class="panel-header bg-secondary-gradient">
      <div class="page-inner py-45">
         <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
            <div class="page-header text-white">
               <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Peminjaman Ruangan </h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">Transaksi </a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a>Transaksi Data Ruangan</a></li>
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
         @if(Session::has('status'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="fas fa-exclamation-circle"></i> Error !</h4>
                    <ul>
                        <li><?php echo Session::get('status') ?></li>
                    </ul>
                </div>
            </div>
         @endif  
      </div>
      <div class="card">
         <div class="card-header">
            <div class="card-title">Data Peminjam</div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-4">
                    <div class="form-group">
                     <label>Nama</label>
                     <input type="text" name="nama" class="form-control" readonly value="{{Auth::user()->nama}}">
                  </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                     <label>Jenis Kelamin</label>
                     <input type="text" name="j_kel" class="form-control" readonly value="{{Auth::user()->j_kel}}">
                  </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                     <label>Telp</label>
                     <input type="text" name="telp" class="form-control" readonly value="{{Auth::user()->no_telp}}">
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card">
         <div class="card-header">
            <div class="card-title">Data Gedung</div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-3">
                    <div class="form-group">
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                       <label>Pilih Gedung</label>
                       <select name="satuan_ruangans_id" class=" form-control select2" id="namaruangans" required>
                          @foreach($gedung as $gedungs)
                             <option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
                          @endforeach
                       </select>
                    </div>
               </div>
               
               <div class="col-md-1">
                    <div class="form-group">
                     <label>Lihat</label>
                     <button class="btn btn-secondary" id="tombollihat" style="display:block;">
                        <span class="btn-label">
                           <i class="fa fa-eye"></i>
                        </span>
                        Lihat
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-header">
            <div class="card-title">Data Ruangan</div>
         </div>
         <div class="card-body">
            <div class="row" id="dataruangan">
               
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Transaksi Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd" method="POST" action="{{ route('dosen.transaksi.peminjamanruangan.tambah')}}" enctype="multipart/form-data" validate>
                  @csrf
                  <div class="form-group">
                     <label>Nama</label>
                     <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                     <input type="hidden" name="iduser" value="{{Auth::user()->id}}"/>
                     <input type="text" class="form-control" name="nama" readonly value="{{Auth::user()->nama}}">
                  </div>
                  <div class="form-group">
                     <label>Nama Gedung</label>
                     <input type="text" class="form-control" name="namagedung" id="namagedung" readonly>
                     <input type="hidden" class="form-control" name="idgedung" id="idgedung" readonly>
                  </div>
                  <div class="form-group">
                     <label>Nama Ruangan</label>
                     <input type="hidden" class="form-control" name="idruangan" id="idruangan" readonly>
                     <input type="text" class="form-control" name="namaruangan" id="namaruangan" readonly>
                  </div>
                  <div class="form-group">
                     <label>Foto Ruangan</label>
                        <img id="gambar" alt="Foto Ruangan" width="400px" height="350px">
                    </div>
                  <div class="form-group">
                     <label>Jumlah Hari</label>
                     <input type="number" min="0" class="form-control" name="jumlah_hari" value="" required>
                  </div>
                  <div class="form-group">
                     <label>Catatan</label>
                     <textarea class="form-control" name="catatan" placeholder="Tambahkan Catatan (Opsional)"></textarea>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary font-weight-bold tombolsimpan">Simpan</button>
                <button type="button" class="btn btn-warning font-weight-bold" data-dismiss="modal">Batal</button>
            </div>
                </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
   $("#peminjamanruangan").addClass("active");

   $(document).on('click', '#tombollihat', function() {
      var data = $('#namaruangans').select2('data')
      var id = data[0].id;
      var gedung = data[0].text;
      var url = '{{ route("dosen.transaksi.peminjamanruangan.detail", ":id") }}';
      url = url.replace(':id', id);
      $.ajax({
         type: 'GET',
         url: url,
         success: function(data){
            if (data.ruangan.length >= 1) {
               $('.daftarproduk').remove();
               for (i = 0; i < data.ruangan.length; i++) {
                  $("#dataruangan").append(
                     '<div class="col-md-2 daftarproduk" style="margin-top: 1em;">'+
                     '<button type="button" class="btn btn-primary btn-block tombolcheckout" data-toggle="modal" data-target="#modal-checkout" data-idgedung="'+id+'" data-idruangan="'+data.ruangan[i].id+'" data-ruangan="'+data.ruangan[i].nama+'" data-fotoruangan="'+data.ruangan[i].foto+'" data-gedung="'+gedung+'" data-gedung="'+gedung+'">'+
                        ''+data.ruangan[i].nama+
                     '</button>'+
                  '</div>');
               }
            }else{
               alert('Ruangan Di Gedung '+gedung+' Tidak Ada !')
            }
             console.log(data);
         },
         error: function(data){
             console.log(data);
         }
      });
   });

   $(document).on('click', '.tombolcheckout', function() {
      $('#namagedung').val($(this).data('gedung'));
      $('#idgedung').val($(this).data('idgedung'));
      $('#namaruangan').val($(this).data('ruangan'));
      $('#idruangan').val($(this).data('idruangan'));
      $("#gambar").attr("src", '../../'+$(this).data('fotoruangan'));
   });
   
</script>
@endsection