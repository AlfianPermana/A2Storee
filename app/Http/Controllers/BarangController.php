<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $barangs = Barang::all();

        return view('barangs.index', compact(
            'barangs'
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // validate request
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'numeric', 'min:1'],
            'harga_beli' => ['required', 'numeric', 'min:1'],
            'harga_jual' => ['required', 'numeric', 'min:1', 'gt:harga_beli'],
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ])->validate();

        // save barang and gambar
        $model = new Barang;
        $model->name =$request->name;
        $model->harga_beli =$request->harga_beli;
        $model->harga_jual =$request->harga_jual;
        $model->stok =$request->stok;
        $model->save();

        // save gambar
        if($request->hasFile('gambar')){
            $request->file('gambar')->move(public_path('gambarbarang/'), $request->file('gambar')->getClientOriginalName());
            $model->gambar = $request->file('gambar')->getClientOriginalName();
            $model->save();
        }

        // redirect to index
        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find barang by id
        $barang = Barang::where('id', $id)->firstOrFail();
        return view('barangs.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $barang = Barang::find($id);
        return view('barangs.update',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'numeric', 'min:1'],
            'harga_beli' => ['required', 'numeric', 'min:1'],
            'harga_jual' => ['required', 'numeric', 'min:1', 'gt:harga_beli'],
        ])->validate();

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil terupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        // find barang by id
        $barang = Barang::findOrfail($id);
        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
