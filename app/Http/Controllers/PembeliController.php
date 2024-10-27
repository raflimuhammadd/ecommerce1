<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('transaksi.*', 'users.name as nama', 'users.telepon as telp')
            ->get();
        $transaksiLunas = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('transaksi.*', 'users.name as nama', 'users.telepon as telp')
            ->where('transaksi.status', '=', 'lunas')
            ->get();
        return view('admin.pembeli.index', compact('transaksi', 'transaksiLunas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('transaksi.*', 'users.name as nama', 'users.telepon as telp', 'users.email as email')
            ->where('transaksi.id', $id)
            ->get();
        $detail = DetailTransaksi::join('transaksi', 'transaksi_id', '=', 'transaksi.id')
            ->join('produks', 'produk_id', '=', 'produks.id')
            ->select('detail_transaksi.*', 'transaksi.status as status', 'transaksi.total as total', 'produks.nama_produk as nama_produk', 'produks.deskripsi as deskripsi', 'produks.foto as foto')
            ->where('detail_transaksi.transaksi_id', $id)
            ->get();
        return view('admin.pembeli.show', compact('detail', 'transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::find($id);
        return view('admin.pembeli.edit', compact('transaksi'));
    }

    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);
        
        if (!$transaksi) {
            return redirect()->route('pembeli')->with('error', 'Transaksi tidak ditemukan!');
        }

        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->route('pembeli')->with('success', 'Transaksi berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
