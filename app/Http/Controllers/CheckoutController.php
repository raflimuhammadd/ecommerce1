<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Keranjang;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            $transaksi = new Transaksi();
            $transaksi->id = rand();
            $transaksi->users_id = auth()->user()->id;
            $transaksi->no_telepon = $request->no_telepon;
            $transaksi->total = $request->total;
            $transaksi->save();

            $keranjang = Keranjang::where('user_id', auth()->user()->id)->get();

            foreach ($keranjang as $cart) {
                $detail_transaksi = new DetailTransaksi();
                $detail_transaksi->transaksi_id = $transaksi->id;
                $detail_transaksi->produk_id = $cart->produk_id;
                $detail_transaksi->quantity = $cart->quantity;
                $hargaBarang = $cart->quantity * $cart->harga;
                $detail_transaksi->harga = $hargaBarang;
                $detail_transaksi->save();
            }

            Keranjang::where('user_id', auth()->user()->id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil',
                'transaction_id' => $transaksi->id,
            ]);
            // return redirect('/coba');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Checkout Error: ' . $e->getMessage());

            return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat melakukan transaksi: ' . $e->getMessage(),
        ]);
        }
    }

    public function generatePDF($id_transaksi)
    {
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('transaksi.*', 'users.name as nama', 'users.email as email')
            ->where('transaksi.id', $id_transaksi)
            ->get();

        $detail = DetailTransaksi::join('transaksi', 'transaksi_id', '=', 'transaksi.id')
            ->join('produks', 'produk_id', '=', 'produks.id')
            ->select('detail_transaksi.*', 'transaksi.status as status', 'transaksi.total as total', 'produks.harga as harga_barang', 'produks.nama_produk as nama_produk')
            ->where('detail_transaksi.transaksi_id', $id_transaksi)
            ->get();

            // dd($transaksi);
        $subtotal = $detail->sum(function ($item) {
            return $item->harga_barang * $item->quantity;
        });

        $persen = 10;
        $ppn = $subtotal * ($persen / 100);

        $data = [
            'transaksi' => $transaksi,
            'detail' => $detail,
            'ppn' => $ppn,
            'subtotal' => $subtotal,
        ];

        $pdf = PDF::loadView('pdf.transaksi', $data);
        return $pdf->download('Transaksi.pdf');
    }

    public function coba($id_transaksi)
    {
        return view('coba');
    }
}
