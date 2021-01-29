@extends('layout.main')

@section('title', 'Halaman Utama')
@php
    $tanggal ="x";
@endphp
@section('main')
    <div class="container ">
        <h1 class="text-center">Donasi Puasa</h1>
        <hr style="max-width: 500px">

        <form method="POST" action="/cart">
            @csrf
            @foreach ($donations as $donasi)
                @if ($tanggal != $donasi->tanggal)
                    <h4 class="text-center">{{ $donasi->nama_puasa }}</h4>
                    <h5 class="text-center"><span class="badge badge-secondary">{{ $donasi->tanggal }}</span></h5>
                    @php
                        $tanggal = $donasi->tanggal
                    @endphp                    
                @endif
                {{-- <input name="id[{{ $donasi->id }}]" type="hidden" value="{{ $donasi->id }}"> --}}

                <div class="row">
                    <div class="col">
                        <div class="card mb-3 mx-auto" style="max-width: 500px;">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-4">
                                    <img src="{{ asset('/asset/ayamfatmawati-merdeka3.jpg') }}" class="card-img" style="border-radius:0%;" alt="...">
                                    @php
                                        if($donasi->target == $donasi->dibayar + $donasi->dalam_proses){
                                            $warna = 'bg-success';
                                        } else {
                                            $warna = 'bg-danger';
                                        }
                                    @endphp
                                    <h5 class="card-text text-center py-2 text-white {{$warna}}">
                                        <strong>{{ $donasi->dibayar + $donasi->dalam_proses }}<small>/{{ $donasi->target }}</small></strong>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h3 class="my-0"><strong>{{ $donasi->nama_resto }}</strong></h3>
                                        <p class="text-muted my-0">{{ $donasi->alamat }}</p>
                                        <h4 class="my-1 text-success"><strong>{{ $donasi->nama_menu }}</strong></h4>
                                        <h4 class=" harga" style="display: none"><strong>{{   ($donasi->harga) }}</strong><small>/paket</small></h4>
                                        <h4><strong>{{   number_format($donasi->harga) }}</strong><small>/paket</small></h4>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control jumlah px-0" id="total" name="total[{{ $donasi->id }}]">
                                        @for ($i = 0; $i <= $donasi->target - ($donasi->dibayar + $donasi->dalam_proses); $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    {{-- <input type="number" id="input{{ $donasi->id }}"
                                        name="Input" value="0" min="0" max="20" step="1" /> --}}
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            <button type="submit" class="btn btn-lg btn-success fixed-bottom mx-auto mb-4" id="btn-bayar" style="display: none"> Total </button>
        </form>

    </div>
    {{-- <script src="{{ asset('/js/bootstrap-input-spinner.js') }}"></script>
    <script>
        $("input[type='number']").inputSpinner()

    </script>

    <script>
        var id = JSON.parse("{{ json_encode($donasi->id) }}");
        id = "#input" + id;
        console.log(id);
        var $changedInput = $(id);
        $changedInput.on("change", function(event) {
            console.log($changedInput.val());
        })

    </script> --}}
    <script>
        $(document).ready(function() {
            $(".jumlah").change(function() {
                var harga = [];
                var total = 0;
                $(".harga").each(function(index) {
                    harga.push(parseInt($(this).text()));
                });
                $(".jumlah").each(function(index) {
                    total += harga[index] * $(this).val();
                });
                if (total != 0) {
                    $('#btn-bayar').css('display','block');
                    total = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                    $('#btn-bayar').text('Total Rp' + total);
                } else {
                    $('#btn-bayar').css('display','none');
                }
            });
        });

    </script>
@endsection
