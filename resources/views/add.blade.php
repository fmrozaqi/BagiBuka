@extends('layout.main')

@section('title','Halaman Utama')

@section('main')
<h1>Tambah Data</h1>
<form method="POST" action="/">
    @csrf
    <div class="form-group">
      <label for="id_rm">Id Rumah Makan</label>
      <input type="text" class="form-control" id="id_rm" placeholder="Id Rumah Makan" name="id_rm" value="{{ old('id_rm') }}">
    </div>
    <div class="form-group">
      <label for="menu">Menu</label>
      <input type="text" class="form-control @error('menu') is-invalid @enderror" id="menu" placeholder="Menu" name="menu" value="{{ old('menu') }}">
      @error('menu')
      <div class="invalid-feedback">
        {{ $message }}
      </div> 
      @enderror
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{ old('harga') }}">
      @error('harga')
      <div class="invalid-feedback">
        {{ $message }}
      </div> 
      @enderror
    </div>
    <div class="form-group">
      <label for="nowPaket">Jumlah Sekarang</label>
      <input type="number" class="form-control" id="nowPaket" placeholder="Jumlah Sekarang" name="nowPaket" value="{{ old('nowPaket') }}">
    </div>
    <div class="form-group">
      <label for="maxPaket">Jumlah Maksimal</label>
      <input type="number" class="form-control" id="maxPaket" placeholder="Jumlah Maksimal" name="maxPaket" value="{{ old('maxPaket') }}">
    </div>
    <button type="submit" class="btn btn-primary">Tambahkan!</button>
  </form>
@endsection