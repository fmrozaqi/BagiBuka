@extends('layout.main')

@section('title','Halaman Utama')

@section('main')
<h1>This is example from ilmucoding.com</h1>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">id RM</th>
            <th scope="col">Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Kebutuhan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paket as $pkt)            
            <tr>
                <th scope="row"> {{ $loop->iteration }} </th>
                <td>{{ $pkt->id_rm }}</td>
                <td><a class="btn btn-primary" href="/{{$pkt->id}}" role="button">{{ $pkt->menu }}</a></td>
                <td>{{ $pkt->harga }}</td>
                <td>{{ $pkt->nowPaket }}/{{ $pkt->maxPaket }}</td>
                <td>
                    <form action="{{ $pkt->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection