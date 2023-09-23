@extends('layouts.main')

@section('title', 'Create Barang')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h2>Input Barang</h2>
    </div>
</div>


<section class="container my-2 bg-dark w-50 text-light p-2">
    <form class="row g-3 p-3" action="{{ route('barangs.update', $barang->id) }}" method="POST" >
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="name" value="{{$barang->name}}"
                name="name">
            @error('name')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Jumlah Barang</label>
            <input type="text" class="form-control" id="inputJumlah" value="{{$barang->stok}}"
                name="stok">
            @error('stok')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Harga Beli</label>
            <input type="text" class="form-control" id="inputHB" value="{{$barang->harga_beli}}"
                name="harga_beli">
            @error('harga_beli')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Harga Jual</label>
            <input type="text" class="form-control" id="inputHJ" value="{{$barang->harga_jual}}"
                name="harga_jual">
            @error('harga_jual')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection