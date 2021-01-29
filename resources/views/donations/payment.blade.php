@extends('layout.main')

@section('title', 'Keranjang Donasi')

@php
    if($status == 0){
        $pesan = "Belum Dibayar";
        $warna = "badge-danger";
    }elseif($status == 1){
        $pesan = "Menunggu Konfirmasi";
        $warna = "badge-warning";
    }else{
        $pesan = "Pembayaran Selesai";
        $warna = "badge-success";
    }
@endphp

@section('main')
    <div class="container text-center">
        @if (session('status'))  
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif
        <h1>Pembayaran Donasi</h1>
        <h3><span class="badge {{ $warna }}">{{ $pesan }}</span></h3>
        @if ($status == 'Belum Dibayar')
            <h4 class="mb-4">Batas Pembayaran <span id="time">99:99:99</h4>
            <hr>            
        @endif
        <h4>{{ $pembayaran }}</h4>
        <h4>085799511135</h4>
        <div class="col">
            <ul class="list-group list-group-flush mx-auto" style="max-width: 500px">
                <li class="list-group-item">
                    @php
                    $total = 0
                    @endphp
                    @foreach ($subtotalDonasi as $donasi)
                        @php
                        // if($item==0)continue;
                        $total += $donasi->subtotal
                        @endphp
                        <div class="row mx-auto align-items-center pt-2">
                            <div class="col-2 text-center">
                                <h5 class="my-0">{{ $donasi->jumlah }}</h5>
                                <p class="my-0">paket</p>
                            </div>
                            <div class="col">
                                <h4 class="my-0">{{ $donasi->nama_menu }}</h4>
                                <p class="my-0">{{ $donasi->nama_resto }}</p>
                            </div>
                            <div class="col-3 text-right">
                                <h5 class="my-0">{{ number_format($donasi->subtotal) }}</h5>
                            </div>
                        </div>
                    @endforeach
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col text-right">
                            <h4 class="my-0">Total : {{ number_format($total) }}</h4>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

        @if ($status == 0)
            <form method="POST" action="/transaction/{{ $id }}">
                @method('patch')
                @csrf
                <button type="submit" class="btn btn-lg btn-success">Sudah Bayar</button>
            </form>
            <a href="/transaction/cancel/{{ $id }}" class="btn btn-lg btn-danger my-3">Cancel</a>
        @endif

        @if ($status == 2 || $status == 1 )
            <form method="POST" action="/transaction/{{ $id }}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-lg btn-success">Donasi lagi!</button>
            </form>
        @endif

    </div>
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                hours, minutes, seconds;
            setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function() {
            var duration = {{ $duration }},
                display = document.querySelector('#time');
            console.log(display);
            startTimer(duration, display);
        };

    </script>
@endsection
