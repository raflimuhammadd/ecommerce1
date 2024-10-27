<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $keranjang = $user->keranjangs()->with('produk')->get();

        $subtotal = $keranjang->sum(function ($item) {
            return $item->produk->harga * $item->quantity;
        });

        $persen = 10;
        $ppn = $subtotal * ($persen / 100);

        $total = $subtotal + $ppn;

        return view('pages.cart', compact('keranjang', 'subtotal', 'ppn', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();

        // Cek apakah produk sudah ada di keranjang
        $existingCartItem = $user->keranjangs()->where('produk_id', $request->produk_id)->first();

        if ($existingCartItem) {
            // Jika sudah ada, update jumlahnya
            $existingCartItem->increment('quantity', $request->quantity);
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            $hargaProduk = Produk::findOrFail($request->produk_id)->harga;
            $user->keranjangs()->create([
                'produk_id' => $request->produk_id,
                'harga' => $hargaProduk * $request->quantity,
            ]);
        }

        return redirect()->route('shop')->with('success', 'Item added to keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update([
            'quantity' => $request->quantity,
            'harga' => $keranjang->produk->harga * $request->quantity,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        // You might want to return updated data as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Item deleted successfully',
            // Add other data you want to update on the client side
        ]);
    }
}
