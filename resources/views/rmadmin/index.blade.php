@extends('layout.rmadmin')

@section('title', 'Donation')

@php
    if($donation!=null){
        $masuk = $donation->dibayar/$donation->target*100;
        $ongoing = $donation->dalam_proses/$donation->target*100;
    }
@endphp

@section('main')
    @if ($donation != null)
        
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <h3 class="box-title">Donasi Masuk</h3>
                        </li>
                        <li class="ml-auto"><span class="counter text-success">{{$donation->dibayar}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <h3 class="box-title">Donasi On Going</h3>
                        </li>
                        <li class="ml-auto"><span class="counter text-warning">{{$donation->dalam_proses}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                        <li>
                            <h3 class="box-title">Target</h3>
                        </li>
                        <li class="ml-auto"><span class="counter text-primary">{{$donation->target}}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Progress</h3>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$masuk}}%" ></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ongoing}}%" ></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Transaction</h3>
                <p class="text-muted">Add class <code>.table</code></p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Puasa</th>
                                <th class="border-top-0">Menu</th>
                                <th class="border-top-0">Harga</th>
                                <th class="border-top-0">tanggal</th>
                                <th class="border-top-0">Masuk</th>
                                <th class="border-top-0">Target</th>
                                <th class="border-top-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_puasa }}</td>
                                    <td>{{ $item->nama_menu }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->dibayar }}</td>
                                    <td>{{ $item->target }}</td>
                                        @if ($item->proses == 1 && $item->status == -1)
                                            <td>      
                                                <a href="/rmadmin/laporan/{{ $item->id }}"><span class="badge badge-info">Laporan</span></a>
                                            </td>
                                        @endif
                                        @if ($item->proses == 1 && $item->status == 0)
                                            <td>
                                                <span class="badge badge-secondary">Inactive</span>
                                            </td>
                                        @endif
                                        @if ($item->proses == 2)
                                            <td>
                                                <span class="badge badge-success">Active</span>
                                            </td>
                                        @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
