@extends('layout.admin')

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
                                <th class="border-top-0">username</th>
                                <th class="border-top-0">nama</th>
                                <th class="border-top-0">alamat</th>
                                <th class="border-top-0">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="" method="POST">
                                    @csrf
                                    <td></td>
                                    <td><input type="text" class="form-control" placeholder="username" name="username" >  </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="nama rumah makan" name="nama" >                                           
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="alamat rumah makan" name="alamat" > 
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Create</button>
                                    </td>
                                </form>
                                       
                            </tr>
                            @foreach ($restaurants as $item)
                                <tr>
                                    <form action="restaurant/{{$item->id}}" method="POST">
                                        @method('patch')
                                        @csrf
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="nama rumah makan" name="nama" value="{{ $item->nama_resto }}">                                           
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="alamat rumah makan" name="alamat" value="{{ $item->alamat }}"> 
                                            
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                    </form>
                                            <form action="restaurant/{{$item->id}}" method="POST">
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
