<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Pesanan::with('barang')->where('status','Pending')->get();
        return view('pesanans.index', compact(
            'pesanans'
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function order(string $id, Request $request): RedirectResponse
    {
        // validate jumlah
        Validator::make($request->all(), [
            'jumlah' => 'required|numeric|min:1'
        ])->validate();

        // validate stok barang
        $barang = Barang::findOrFail($id);
        if ($barang->stok == 0)
            return redirect()->back()->with('error', 'Stok habis');

        // validate stok > jumlah
        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Permintaan melebihi stok. silahkan sesuaikan dengan stok');
        }

        // create pesanan
        Pesanan::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'total' => $request->jumlah * $barang->harga_jual,
            'status' => 'PENDING'
        ]);

        // update stok barang
        $barang->update([
            'stok' => $barang->stok - $request->jumlah
        ]);

        // redirect to pesanan.index
        return redirect()->route('pesanans.index')->with('success', 'Berhasil menambahkan pesanan');
    }

    public function checkout()
    {
        // get all pending pesanan
        $pendings = Pesanan::where('status', 'PENDING')->get();
        $count = count($pendings);

        // validate if there is no pending pesanan
        if ($count <= 0) {
            return redirect()->route('pesanans.index')->with('error', 'Tidak ada data yang pending');
        }

        // update all pending pesanan to success
        Pesanan::where('status', 'PENDING')->update(['status' => 'SUCCESS']);
        return redirect()->route('pesanans.index')->with('success', 'Berhasil mengcheckout sejumlah ' . $count . ' Barang');
    }

    public function laporan()
    {
        $pesanans = Pesanan::orderBy('created_at', 'DESC')->with('barang')->paginate(8);
        return view('export', compact(
            'pesanans'
        ));
    }

    public function ExportExcel()
    {
        $pesanans = Pesanan::with('barang')->get();
        $data = $pesanans->map(function($pesanans){
            return [
                $pesanans->id,
                $pesanans->barang->name,
                $pesanans->jumlah,
                $pesanans->total,
                $pesanans->created_at,
            ];
        });
        return Excel::download(new PenjualanExport($data), 'datapesanan.xlsx');
    }
    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
