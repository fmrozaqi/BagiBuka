@extends('layout.admin')

@section('title', 'Donation')

@section('main')

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Donation</h3>
                <p class="text-muted">Add class <code>.table</code></p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">RM</th>
                                <th class="border-top-0">menu</th>
                                <th class="border-top-0">harga</th>
                                <th class="border-top-0">dibayar</th>
                                <th class="border-top-0">proses</th>
                                <th class="border-top-0">target</th>
                                <th class="border-top-0">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_resto }}</td>
                                    <td>{{ $item->nama_menu }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->dibayar }}</td>
                                    <td>{{ $item->dalam_proses }}</td>
                                    <td>{{ $item->target }}</td>
                                    <td>
                                        @if ($item->proses == 0)
                                            <a href="donation/verifikasi/{{ $item->id }}"><span class="badge badge-warning">Verifikasi</span></a>
                                            <a href="donation/tolak/{{ $item->id }}"><span class="badge badge-danger">Tolak</span></a>
                                        @endif
                                        @if ($item->proses == -1)
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                        @if ($item->proses == -2)
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                        @if ($item->proses == 1)
                                            <span class="badge badge-success">Diterima</span>
                                        @endif
                                        @if ($item->proses == 2)
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

@endsection
