@extends('layouts.main')

@section('title', 'Pesanan Anda')

@section('content')
    <div class="container mt-5">
        @include('partials.flash')

        <h2 class="mb-1 fw-bold">Info Barang</h2>
        <p class="mb-4">Berikut adalah daftar barang yang tersedia.</p>

        <a href="{{ route('pesanans.export') }}" class="mb-4 btn btn-success">Checkout</a>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Jumlah Pembelian</th>
                    <th>Harga Barang</th>
                    <th>Tanggal Pembelian</th>
                    <th>Jumlah Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $pesanan)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $pesanan->barang->name }} </td>
                        <td> {{ $pesanan->jumlah }} </td>
                        <td> Rp. {{ number_format($pesanan->barang->harga_jual) }} </td>
                        <td> {{ $pesanan->created_at }} </td>
                        <td> Rp. {{ number_format($pesanan->total) }} </td>
                        <td>
                            @php
                                switch ($pesanan->status) {
                                    case 'PENDING':
                                        $class = 'warning';
                                        break;
                                    case 'SUCCESS':
                                        $class = 'success';
                                        break;
                                    default:
                                        $class = 'danger';
                                        break;
                                }
                            @endphp
                            <span class="badge rounded-pill text-bg-{{ $class }} text-white">
                                {{ $pesanan->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <span>Belum ada pesanan</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
