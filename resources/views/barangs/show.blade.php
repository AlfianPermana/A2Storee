@extends('layouts.main')

@section('title', 'Detail Barang')

@push('styles')
    <style>
        #gambar {
            width: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
@endpush


@section('content')
    <div class="container">

        @include('partials.flash')

        <div class="py-5 row">
            <div class="mb-4 col-12 col-lg-6 mb-lg-0">
                <div class="p-3 bg-white card rounded-3">
                    <div class="card-body">
                        <h3 class="card-title fw-bold text-uppercase">{{ $barang->name }}</h3>
                        <p class="card-text fw-bold">Rp. {{ number_format($barang->harga_jual) }}</p>
                        <p>Stok : {{ $barang->stok }}</p>
                        @if ($barang->stok == 0)
                            <div class="mb-3 form-group">
                                <button class="btn btn-danger">
                                    Stok Habis
                                </button>
                            </div>
                        @else
                            <form action="{{ route('pesanans.order', $barang->id) }}" method="POST">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="jumlah" class="mb-1">Jumlah Beli</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="1">
                                    @error('jumlah')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-warning">Order</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <img src="{{asset('gambarbarang/' .$barang->gambar)}}" class="border rounded-3" id="barang" >
            </div>
        </div>
    </div>
@endsection
