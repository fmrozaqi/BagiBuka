@extends('layout.admin')

@section('title', 'Transaction')

@section('main')

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
                                <th class="border-top-0">id</th>
                                <th class="border-top-0">nama</th>
                                <th class="border-top-0">pembayaran</th>
                                <th class="border-top-0">tanggal</th>
                                <th class="border-top-0">total</th>
                                <th class="border-top-0">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subtotal as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->pembayaran }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                    @if ($item->status == 4)
                                        <td><span class="badge badge-danger">Expired</span></td>
                                    @else
                                        @if ($item->status == 0)
                                            <td><span class="badge badge-danger">Belum dibayar</span></td>
                                        @endif
                                        @if ($item->status == 1)
                                            <td>      
                                                <a href="/admin/verifikasi/{{ $item->id }}"><span class="badge badge-warning">Verifikasi</span></a>
                                            </td>
                                        @endif
                                        @if ($item->status == 2)
                                            <td>
                                                <span class="badge badge-success">Telah dibayar</span>
                                                <a href="/admin/unverifikasi/{{ $item->id }}"><span class="badge badge-danger">Cancel</span></a>
                                            </td>
                                        @endif
                                        @if ($item->status == 3)
                                            <td>
                                                <span class="badge badge-danger">Cancelled</span>
                                            </td>
                                        @endif
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
