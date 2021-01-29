@extends('layout.rmadmin')

@section('title', 'Profile')

@section('main')
    @if (session('status'))  
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    @if (session('status_berhasil'))  
        <div class="alert alert-success">
            {{ session('status_berhasil') }}
        </div>
    @endif

    <!-- Row -->
    <div class="row">

        <!-- Column -->
        <div class="col-md-12 col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-heading">
                    EDIT PROFILE
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-material" action="profile/{{ $user->id }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Nama Rumah Makan</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="{{ $restaurant->nama_resto }}"
                                    class="form-control p-0 border-0" value="{{ $restaurant->nama_resto }}" name="nama_resto" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Alamat</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="{{ $restaurant->alamat }}" class="form-control p-0 border-0"
                                    name="alamat" id="alamat" value="{{ $restaurant->alamat }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Username</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="{{ $user->username }}" class="form-control p-0 border-0" value="{{ $user->username }}" name="username" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-12 col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-heading">
                    GANTI PASSWORD
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-material" action="profile/change_password/{{ $user->id }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Parword lama</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" placeholder="Parword lama"
                                    class="form-control p-0 border-0" name="password" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Password Baru</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" placeholder="Password Baru" class="form-control p-0 border-0" name="new_password" value="" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Konfimasi Password Baru</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" placeholder="Konfimasi Password Baru" class="form-control p-0 border-0" name="confirm_password" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Ganti Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->

@endsection
