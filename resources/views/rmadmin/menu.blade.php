@extends('layout.rmadmin')

@section('title', 'Restaurant')

@section('main')

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Restaurant</h3>
                <p class="text-muted">Add class <code>.table</code></p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">id</th>
                                <th class="border-top-0">menu</th>
                                <th class="border-top-0">harga</th>
                                <th class="border-top-0">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="" method="POST">
                                    @csrf
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="nama menu" name="nama" >                                           
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="harga" name="harga" > 
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Create</button>
                                    </td>
                                </form>
                                       
                            </tr>
                            @foreach ($menus as $item)
                                <tr>
                                    <form action="menu/{{$item->id}}" method="POST">
                                        @method('patch')
                                        @csrf
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="nama menu" name="nama" value="{{ $item->nama_menu }}">                                           
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="harga" name="harga" value="{{ $item->harga }}"> 
                                            
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                    </form>
                                            <form action="menu/{{$item->id}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
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
