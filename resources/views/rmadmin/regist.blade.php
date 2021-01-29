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
        <div class="col-md-12 col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-heading">
                    PENDAFTARAN PAKET PUASA 
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-material" action="" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Jenis Puasa</label>
                            <div class="col-md-12 border-bottom p-0">
                                <select class="form-control" id="puasa" name="puasa">
                                    @foreach ($puasa as $ps)
                                        <option value="{{ $ps->id }}">{{ $ps->nama_puasa }} {{ $ps->tanggal }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Menu Paket</label>
                            <div class="col-md-12 border-bottom p-0">
                                <select class="form-control" id="menu" name="menu">
                                    @foreach ($menu as $mn)
                                        <option value="{{ $mn->id }}">{{ $mn->nama_menu }} Rp{{ number_format($mn->harga) }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="target" class="col-md-12 p-0">Target Maksimal</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="number" placeholder="Target" class="form-control p-0 border-0"
                                    name="target" id="target" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
        
    </div>
    <div class="row">

        <!-- Column -->
        <div class="col">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Status Pendaftaran Paket</h3>
                    <p class="text-muted">Add class <code>.table</code></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Paket</th>
                                    <th class="border-top-0">Menu</th>
                                    <th class="border-top-0">Harga</th>
                                    <th class="border-top-0">Target</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donasi as $dns)                                    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $dns->nama_puasa }} ({{ date("d/m/Y", strtotime($dns->tanggal)) }})                                         
                                        </td>
                                        <td>{{ $dns->nama_menu }}</td>
                                        <td>{{ $dns->harga }}</td>
                                        <td>{{ $dns->target }}</td>
                                        <td>
                                            @if ($dns->proses == 0)
                                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                            @endif
                                            @if ($dns->proses == -1)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                            @if ($dns->proses == -2)
                                                <span class="badge badge-danger">Expired</span>
                                            @endif
                                            @if ($dns->proses == 1)
                                                <span class="badge badge-success">Diterima</span>
                                            @endif
                                            @if ($dns->proses == 2)
                                                <span class="badge badge-primary">Aktif</span>
                                            @endif
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        
    </div>
    <!-- Row -->

@endsection
