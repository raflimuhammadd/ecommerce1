@extends('layouts.app')
@section('front')
    <section class="bg-cover bg-center h-screen relative flex items-center text-white"
    style="background-image: url('https://images.unsplash.com/photo-1522335579687-9c718c5184d7?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D;">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di Yasir Health Store</h1>
        <p class="text-lg mb-8">Meyediakan kebutuhan kesehatan anda </p>
            <a href="{{ route('shop') }}"
                class="bg-yellow-500 text-gray-900 hover:bg-yellow-400 px-6 py-3 rounded-full text-lg font-semibold transition duration-300">View
                Menu</a>
        </div>
    </section>
    <section class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl text-black font-bold mb-8">Our Menu</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-14">
                @foreach ($produk as $pr)
                    <div class="bg-white flex flex-col justify-between p-6 rounded-lg shadow-lg">
                        <img src="{{ asset('storage/produks/' . basename($pr->foto)) }}"
                            class="w-full h-60 object-cover object-center mb-4 rounded">
                        <h3 class="text-xl font-semibold mb-2">{{ $pr->nama_produk }}</h3>
                        <p class="text-gray-700 mb-4">{{ $pr->deskripsi }}</p>
                        <span class="text-yellow-500 font-bold text-lg">Rp.
                            {{ number_format($pr->harga, 0, ',', '.') }}</span>

                        <!-- Formulir untuk menambahkan produk ke dalam keranjang -->
                        <form action="{{ route('keranjang.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $pr->id }}">
                            <input type="number" name="quantity" value="1" min="1" hidden>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
