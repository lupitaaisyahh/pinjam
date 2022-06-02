@extends('layouts.app')
@section('title', 'Transaksi Data Barang')
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
               <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Peminjaman Barang </h4>
               <ul class="breadcrumbs">
                  <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a href="#" class="text-white">Transaksi </a></li>
                  <li class="separator"><i class="flaticon-right-arrow"></i></li>
                  <li class="nav-item"><a>Transaksi Data Barang</a></li>
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
                     <label>Nama </label>
                     <input type="text" name="nama" class="form-control" readonly value="{{Auth::user()->nama}}">
                  </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                     <label>Jenis Kelamin</label>
                     <input type="text" name="nama" class="form-control" readonly value="{{Auth::user()->j_kel}}">
                  </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                     <label>Telp</label>
                     <input type="text" name="nama" class="form-control" readonly value="{{Auth::user()->no_telp}}">
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card">
         <div class="card-header">
            <div class="card-title">Data Barang</div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-3">
                    <div class="form-group">
                       <label>Data Barang</label>
                       <select name="satuan_barang_id" class=" form-control select2" id="namabarang" required>
                          @foreach($barang as $barangs)
                             <option value="{{$barangs->id}}">{{$barangs->nama}}</option>
                          @endforeach
                       </select>
                    </div>
               </div>
               <div class="col-md-3">
                    <div class="form-group">
                     <label>Jumlah</label>
                     <input type="text" name="jumlah" id="jlhbarang" class="form-control" placeholder="Masukkan Jumlah Barang" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
                  </div>
               </div>
               <div class="col-md-3">
                    <div class="form-group">
                     <label>Tangal</label>
                     <input type="text" name="nama" class="form-control" readonly value="{{ date('d-m-Y') }}">
                  </div>
               </div>
               <div class="col-md-1">
                    <div class="form-group">
                     <label>Tambah</label>
                     <button class="btn btn-secondary" id="tomboltambah" style="display:block;">
                        <span class="btn-label">
                           <i class="fa fa-plus"></i>
                        </span>
                        Tambah
                     </button>
                  </div>
               </div>
               <div class="col-md-1">
                    <div class="form-group">
                     <label>Checkout</label>
                     <button class="btn btn-secondary tombolcheckout" data-toggle="modal" data-target="#modal-checkout" style="display:block;">
                        <span class="btn-label">
                           <i class="fas fa-cart-arrow-down"></i>
                        </span>
                        Checkout
                     </button>
                  </div>
               </div>
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
                <form id="formAdd" method="POST" action="{{ route('dosen.transaksi.peminjamanbarang.tambah')}}" enctype="multipart/form-data" validate>
                  @csrf
                  <div class="form-group">
                     <label>Nama</label>
                     <input type="hidden" name="tgl_transaksi" value="<?php echo date('d-m-Y');?>"/>
                     <input type="hidden" name="iduser" value="{{Auth::user()->id}}"/>
                     <input type="text" class="form-control" name="nama" readonly value="{{Auth::user()->nama}}">
                  </div>
                  <div class="form-group">
                     <label>Jenis Kelamin</label>
                     <input type="text" class="form-control" name="nim" readonly value="{{Auth::user()->j_kel}}">
                  </div>
                  <div class="form-group">
                     <label>No Telp</label>
                     <input type="text" class="form-control" name="no_telp" readonly value="{{Auth::user()->no_telp}}">
                  </div>
                  <div class="form-group">
                     <label>Data Barang</label>
                     <div id="totalproduks">
                                                  
                     </div>
                     
                  </div>
                  <div class="form-group">
                     <label>Lama Peminjaman</label>
                     <input type="number" name="lama_pinjam" id="lama_pinjams" class="form-control" placeholder="Masukkan Lama Pinjam (Hari)" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="this.setCustomValidity('')">
                  </div>
                  <div class="form-group">
                     <label>Catatan</label>
                     <textarea class="form-control" name="catatan" placeholder="Tambahkan Catatan (Opsional)"></textarea>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info font-weight-bold" id="tombolclear">Clear</button>
                <button type="submit" class="btn btn-primary font-weight-bold tombolsimpan" disabled>Simpan</button>
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
   
   $(document).on('click', '#tombolclear', function() {
      $('.inputbaru').remove();
      $('.inputbarang').remove();
      $('#lama_pinjams').val('');
      $('.tombolsimpan').attr("disabled", true);
   });

   $(document).on('click', '#tomboltambah', function() {
      var data = $('#namabarang').select2('data')
      var id = data[0].id;
      var barang = data[0].text;
      var jlhbarang = $('#jlhbarang').val();

      if( jlhbarang.length == 0 || jlhbarang == 0) {
         alert("Masukkan Jumlah Barang !");
      }else{
         if( $("#barang_id"+id).length == 0 ) {
         $("#formAdd").append(
               '<input type="hidden" name="barang_id[]" class="inputbaru" id="barang_id'+id+'" value="'+id+'"/>'
               +'<input type="hidden" name="jumlah[]" class="inputbaru" id="jumlah'+id+'" value="'+ jlhbarang +'"/>'
            );
         $("#totalproduks").append(
               '<input type="text" class="form-control inputbarang" value="'+barang+' ('+jlhbarang+')" readonly style="margin-top: 3px;">'
            );
         alert("Berhasil Ditambahkan !");
         $('.tombolsimpan').attr("disabled", false);
         $('#jlhbarang').val("");
         }else{
            alert("Barang Sudah Ditambahkan !");
         }
      }
   });

   $(document).on('click', '.tomboltambah', function() {
        if( $("#produkcart"+$(this).data('id')).length == 0 ) {
         $('#inputuang').val(" ");
            $('#inputtotal').val(" ");
         // refresh form
         var id = $(this).data('id');
         var idoutlet = $(this).data('idoutlet');
         var hargajual = $(this).data('harga');
         var namaproduk = $(this).data('nama_produk');
           var totalrupiah = formatRupiah(""+(hargajual)+"", "");
           var jumlah_barang = 1;

            $("#tbody").append(
               '<tr id="produkcart'+id+'" class="products">'
                  +'<td class="align-items-center align-middle font-weight-bolder" style="margin-left:100px;">'
                     +'<a href="#" class="text-dark text-hover-primary">'+namaproduk+'</a>'
                  +'</td>'
                  +'<td class="text-center align-middle" id="jumlah_barang'+id+'"> 1'
                  +'</td>'
                  +'<td class="text-right align-middle font-weight-bolder font-size-h8" id="totalrupiah'+id+'">'+ totalrupiah +'</td>'
                  +'<td class="text-right align-middle">'
                     +'<button type="button" class="btn btn-danger btn-xs font-size-xs kurangproduk" data-idoutlet="'+idoutlet+'" data-id="'+id+'" data-harga="'+hargajual+'" style="display:inline;"><i class="fas fa-minus"></i></button>'
                     +'<button type="button" class="btn btn-danger btn-xs font-size-xs hapusproduk" id="hapusproduk'+id+'" data-id="'+id+'" data-idtabel="#produkcart'+id+'"><i class="fas fa-trash"></i></button>'
                  +'</td>'
               +'</tr>'
            );
            $("#formAdd").append(
               '<input type="hidden" name="master_produk_id[]" class="inputbaru" id="master_produk_id'+id+'" value="'+id+'"/>'
               +'<input type="hidden" name="harga_jual[]" class="inputbaru" id="harga_jual'+id+'"  value="'+ hargajual +'"/>'
               +'<input type="hidden" name="jumlah[]" class="inputbaru" id="jumlah'+id+'" value="'+ jumlah_barang +'"/>'
               +'<input type="hidden" name="idoutlet[]" class="inputbaru" id="idoutlet'+idoutlet+'" value="'+ idoutlet +'"/>'
            );
            if ($("#inputsubtotal").val() < 1) {
               // Jika Ada
               $("#subtotal").text(totalrupiah);
               $('#inputsubtotal').val(totalrupiah);
            }else{
               totallama = Number($("#inputsubtotal").val().replaceAll('.', ''));
               var subtotal = hargajual+totallama;
               $("#subtotal").text(formatRupiah(""+(subtotal)+"", ""));
               // forminput
               $('#inputsubtotal').val(formatRupiah(""+(subtotal)+"", ""));
            }
        } else {
         // barang baru
            var id = $(this).data('id');
            var idoutlet = $(this).data('idoutlet');
         var hargajual = $(this).data('harga');
            // data barang sebelumnya
           var jumlah_barang_lama = $('#jumlah'+id).val();
         var jumlahbaru = Number(jumlah_barang_lama)+Number(1);
         //perhitungan baru
         var subtotal = Number($("#inputsubtotal").val().replaceAll('.', ''));
         var total_baru = Number(hargajual)+Number(subtotal);
            // ditabel
            $('#jumlah_barang'+id).text(Number(jumlah_barang_lama)+1);
            $('#totalrupiah'+id).text(formatRupiah(""+(hargajual*jumlahbaru)+"", ""));
            $("#subtotal").text(formatRupiah(""+(total_baru)+"", ""));
            // updatedata
            $('#inputsubtotal').val(formatRupiah(""+(total_baru)+"", ""));
            
            $('#master_produk_id'+id+'').remove();
            $('#harga_jual'+id+'').remove();
            $('#jumlah'+id+'').remove();

         $("#formAdd").append(
               '<input type="hidden" name="master_produk_id[]" class="inputbaru" id="master_produk_id'+id+'" value="'+id+'"/>'
               +'<input type="hidden" name="harga_jual[]" class="inputbaru" id="harga_jual'+id+'"  value="'+ hargajual*jumlahbaru +'"/>'
               +'<input type="hidden" name="jumlah[]" class="inputbaru" id="jumlah'+id+'" value="'+jumlahbaru+'"/>'
               +'<input type="hidden" name="idoutlet[]" class="inputbaru" id="idoutlet'+id+'" value="'+idoutlet+'"/>'
            );
       }
   });
</script>
@endsection