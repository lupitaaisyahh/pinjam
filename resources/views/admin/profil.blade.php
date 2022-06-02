@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')
<div class="content">
    <div class="panel-header bg-secondary-gradient">
        <div class="page-inner py-45">
            <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
                <div class="page-header text-white">
                    <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Manajemen User</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="#"><i class="flaticon-home text-white"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="#" class="text-white">Admin</a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a>Data</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner row mt--5">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('../../public/assetsnew/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="{{ url('public/assetsnew/img/avatar-1.png') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">{{Auth::user()->nama}}</div>
                        <div class="job">Administrator</div>
                        <div class="desc">{{Auth::user()->email}}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number">{{Auth::user()->j_kel}}</div>
                            <div class="title">Jenis Kelamin</div>
                        </div>
                        <div class="col">
                            <div class="number">{{Auth::user()->no_telp}}</div>
                            <div class="title">Telp</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Profil Admin</div>
                </div>
                <div class="box-body">
                    <div class="col-md-12" style="margin-bottom:3em;">
                            <form method="post" enctype="multipart/form-data" class="form-horizontal" action="{{ route('admin.ubahprofil', Auth::user()->id)}}">
                                @csrf
                                @if($errors->any())
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible">
                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                        <ul>
                                            @foreach($errors->getMessages() as $this_error)
                                            <li>{{$this_error[0]}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <div class="box-body">
                                    <input type="hidden" name="id" value="{{$data->id}}}">
                                    <div class="form-group">
                                        <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required oninvalid="this.setCustomValidity('Masukkan Nama')" oninput="this.setCustomValidity('')" value="{{ $data->nama }}"  onkeypress="return /[a-z]/i.test(event.key)">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                            <select name="j_kel" id="j_kels" class="form-control" required>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Telpon</label>
                                            <input type="number" min="0" name="no_telp" class="form-control" placeholder="Masukkan Telpon" required oninvalid="this.setCustomValidity('Masukkan Telpon')" oninput="this.setCustomValidity('')" value="{{ $data->no_telp }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required oninvalid="this.setCustomValidity('Masukkan Username')" oninput="this.setCustomValidity('')" value="{{ $data->username }}"  onkeypress="return /[a-z]/i.test(event.key)">
                                    </div>
                                    <div class="form-group">
                                        <label>E-Mail</label>
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan E-Mail" required oninvalid="this.setCustomValidity('Masukkan E-Mail')" oninput="this.setCustomValidity('')" value="{{ $data->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                                    </div>
                                </div>
                                <center style="margin-top: 1em;">
                                    <button type="submit" class="btn btn-primary btn-forminput">Simpan</button>
                                </center>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $("#porfiladmin").addClass("active");
</script>
@endsection