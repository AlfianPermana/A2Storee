@extends('layouts.main')

@section('title', 'Info Barang')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2>Info Barang</h2>
        </div>
        <div class="form-outline">
            <input type="search" id="form1" class="form-control" placeholder="Cari Barang Apa?" aria-label="Search" />
        </div>
    </div>

    <div class="container mt-3">
        <div class="container" style="height : 900px">
            <div class="card border border-dark rounded overflow-auto" style="height:800px;">
                <div class="container mt-4">
                <div class="row row-cols-4 row-cols-md-4 g-4">
                @foreach ($barangs as $barang)
                <div class="col">
                  <div class="card" style="width:15rem;">
                    <a href="{{ route('barangs.show', $barang->id) }}" class="text-decoration-none">
                    <div class="text-center">
                      <img src="{{asset('gambarbarang/' .$barang->gambar)}}" class="crd-img-top" id="gambarbarang" alt="...">
                    <div class="card-body">
                    </a>
                      <h6 class="card-title">{{ $barang->name}}</h6>
                      <p> Harga Jual : Rp. {{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                      <p> Harga Beli : Rp. {{ number_format($barang->harga_beli, 0, ',', '.') }}</p>
                      <p class="card-text">Stock Tersedia : {{ $barang->stok }}</p>


                                <div class="row">
                                    <div class="col">
                                        <a href="{{ url('barangs/'.$barang->id.'/edit')}}" class="rounded-2 btn btn-primary btn-sm">UPDATE</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="rounded-2 btn btn-danger btn-sm" type="submit">DELETE</button>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                    
                </div>
                </div>
                
            </div>    
        </div>
        
    </div>
        

    </div>
@endsection
