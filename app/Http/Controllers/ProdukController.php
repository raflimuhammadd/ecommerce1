<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


            $request->validate([
                'nama_produk' => 'required',
                'deskripsi' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'harga' => 'required|numeric',
            ]);
            // dd($request->all());

            // Dapatkan nama file yang unik
            $fotoName = uniqid() . '.' . $request->file('foto')->extension();

            // Upload foto ke direktori storage dengan nama yang unik
            $fotoPath = $request->file('foto')->storeAs('public/produks', $fotoName);

            // Simpan produk baru ke database
            Produk::create([
                'nama_produk' => $request->nama_produk,
                'deskripsi' => $request->deskripsi,
                'foto' => 'produks/' . $fotoName,
                'harga' => $request->harga,
            ]);

            return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        // Anda bisa melempar variabel $produk ke view edit
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $produk = Produk::findOrFail($id);

        // Validasi form jika dibutuhkan
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Hapus foto lama jika ada dan gambar baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage
            $fotoPath = 'produks/' . basename($produk->foto);
            if (Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            // Simpan gambar baru ke storage
            $foto = $request->file('foto');
            $fotoPath = $foto->store('produks', 'public');
            $produk->foto = $fotoPath;
        }

        // Update data produk
        $produk->nama_produk = $request->input('nama_produk');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->harga = $request->input('harga');
        $produk->save();

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        if ($produk->foto) {
            $fotoPath = 'produks/' . basename($produk->foto);
            if (Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus');
    }
}
