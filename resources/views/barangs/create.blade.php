@extends('layouts.main')

@section('title', 'Create Barang')

@section('content')
    <div class="container mt-5">
        @include('partials.flash')

        <h2 class="mb-1 fw-bold">Tambah Barang</h2>
        <p class="mb-4">Silahkan isi form berikut untuk menambahkan barang baru.</p>

        <div class="row">
            <div class="mb-4 col-12 col-lg-6 mb-lg-0">
                <form class="p-4 mb-4 bg-white border row rounded-3" action="{{ route('barangs.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control w-100 @error('name') is-invalid @enderror" id="name"
                            placeholder="Nama Barang" name="name" value="{{ old('name') }}" required autofocus></input>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control w-100 @error('stok') is-invalid @enderror" id="stok"
                            placeholder="Jumlah Stok" name="stok" value="{{ old('stok') }}" required></input>
                        @error('stok')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control w-100 @error('harga_beli') is-invalid @enderror"
                            id="harga_beli" placeholder="Harga Beli Barang" name="harga_beli"
                            value="{{ old('harga_beli') }}" required></input>
                        @error('harga_beli')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control w-100 @error('harga_jual') is-invalid @enderror"
                            id="harga_jual" placeholder="Harga Jual Barang" name="harga_jual"
                            value="{{ old('harga_jual') }}" required></input>
                        @error('harga_jual')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 row">
                        <label for="gambar" class="form-label">Gambar Barang</label>
                        <input type="file" class="form-control w-100 @error('gambar') is-invalid @enderror"
                            id="gambar" name="gambar" id="gambar" required></input>
                        @error('gambar')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-dark">Tambah</button>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-6">
                <div class="p-4 bg-white border rounded-3">
                    <div id="placeholderContainer" class="rounded-3">
                        <img id="placeholder" alt="Gambar Barang" class="border d-none rounded-3">
                    </div>

                    @push('styles')
                        <style>
                            #placeholderContainer {
                                background-color: #f8fafc;
                                width: 100%;
                                height: 460px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            #placeholder {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                object-position: center;
                            }
                        </style>
                    @endpush

                    @push('scripts')
                        <script>
                            const inputGambar = document.getElementById('gambar');
                            const placeholder = document.getElementById('placeholder');

                            inputGambar.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.addEventListener('load', function() {
                                        placeholder.setAttribute('src', this.result);
                                        placeholder.classList.remove('d-none');
                                    });
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection
