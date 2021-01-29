@extends('layout.main')

@section('title', 'Keranjang Donasi')

@section('main')
    <div class="container">
        <h1 class="text-center">Keranjang Donasi</h1>
        <div class="col">
            <ul class="list-group list-group-flush mx-auto" style="max-width: 500px">
                <li class="list-group-item">
                    @php
                    $total = 0
                    @endphp
                    @foreach ($cart as $id => $item)
                        @php
                        if($item==0)continue;
                        $total += $detail_menu[$loop->index]->harga * $item
                        @endphp
                        <div class="row mx-auto align-items-center pt-2">
                            <div class="col-2 text-center">
                                <h5 class="my-0">{{ $item }}</h5>
                                <p class="my-0">paket</p>
                            </div>
                            <div class="col">
                                <h4 class="my-0">{{ $detail_menu[$loop->index]->nama_menu }}</h4>
                                <p class="my-0">{{ $detail_rm[$loop->index]->nama_resto }}</p>
                            </div>
                            <div class="col-3 text-right">
                                <h5 class="my-0">{{ number_format($detail_menu[$loop->index]->harga * $item) }}</h5>
                            </div>
                        </div>
                    @endforeach
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col text-right">
                            <h4 class="my-0">Total : Rp{{ number_format($total) }}</h4>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        </ul>
        
        <form method="POST" action="/transaction" class="mx-auto" style="max-width: 500px">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="phone">No Telp</label>
                    <input type="tel" class="form-control" id="phone" placeholder="No Telp" name="phone" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="pembayaran">Pembayaran</label>
                    <select id="pembayaran" class="form-control" name="pembayaran">
                        <option selected>OVO</option>
                        <option>GOPAY</option>
                        <option>Linkaja</option>
                        <option>Virtual Account</option>
                        <option>Transfer</option>
                    </select>
                </div>
                <div class="form-group col text-center mx-auto">
                  <button type="submit" class="btn btn-lg btn-success mb-4" type="submit">Bayar Rp{{ number_format($total) }}</button>
                </div>
            </div>
          </form>

    </div>
@endsection
