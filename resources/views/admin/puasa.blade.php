@extends('layout.admin')

@section('title', 'Puasa')

@section('main')

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Puasa</h3>
                <p class="text-muted">Add class <code>.table</code></p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">nama</th>
                                <th class="border-top-0">tanggal</th>
                                <th class="border-top-0">status</th>
                                <th class="border-top-0">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="POST">
                                @csrf
                                <td></td>
                                <td><input type="text" class="form-control" placeholder="Nama Puasa" name="nama" >  </td>
                                <td>
                                    {{-- <input type="text" class="date form-control" placeholder="Tanggal" name="tanggal" >                                            --}}
                                    <input type="date" class=" form-control" placeholder="Tanggal" name="tanggal" >                                           
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Create</button>
                                </td>
                            </form>
                            @foreach ($puasa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_puasa }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        @if ($item->status==-1)
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                        @if ($item->status==0)
                                            <a href="puasa/activate/{{$item->id}}">
                                                <span class="badge badge-warning">Inactive</span>
                                            </a>
                                        @endif
                                        @if ($item->status==1)
                                            <a href="puasa/deactivate/{{$item->id}}">
                                                <span class="badge badge-success">Active</span>
                                            </a>
                                        @endif
                                    </td> 
                                    <td>
                                        <form action="puasa/{{$item->id}}" method="POST">
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

    <script>
        $(document).ready(function() {

            $('.date').datepicker({
                format: 'dd/mm/yyyy'
            });
        });
    </script> 

@endsection
