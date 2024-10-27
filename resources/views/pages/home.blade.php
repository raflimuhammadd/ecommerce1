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

    <div class="px-10">
        <section class="py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl text-black font-bold mb-8">Photo Gallery</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <img src="{{ asset('gambar/galery.jpg') }}" alt="Gallery Image 1"
                            class="w-full h-48 object-cover mb-4 rounded">
                    </div>
                    <!-- Tambahkan lebih banyak gambar galeri di sini -->
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <img src="{{ asset('gambar/galery2.jpg') }}" alt="Galery Image 2"
                            class="w-full h-48 object-cover mb-4 rounded">
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <img src="{{ asset('gambar/galery3.jpg') }}" alt="Galery Image 2"
                            class="w-full h-48 object-cover mb-4 rounded">
                    </div>
                </div>
        </section>

        <div class="glide">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl text-black font-bold mb-8 text-center">Top Sold</h2>
            </div>

            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide"> <!-- Menu Item 7 -->
                        <img src="{{ asset('gambar/masker.jpg') }}">
                        <h3 class="text-xl text-black font-semibold mb-2">Masker</h3>
                        <span class="text-yellow-500 font-bold text-lg">Rp. 10.000</span>
                    </li>
                    <li class="glide__slide"> <!-- Menu Item 8 -->
                        <img src="{{ asset('gambar/vitamin.jpg') }}">
                        <h3 class="text-xl text-black font-semibold mb-2">Vitamin</h3>
                        <span class="text-yellow-500 font-bold text-lg">Rp. 25.000</span>
                    </li>
                    <li class="glide__slide"> <!-- Menu Item 8 -->
                        <img src="{{ asset('gambar/obat.jpg') }}">
                        <h3 class="text-xl text-black font-semibold mb-2">Obat</h3>
                        <span class="text-yellow-500 font-bold text-lg">Rp. 20.000</span>
                    </li>
                </ul>
            </div>
        </div>

        <section class="py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl text-black font-bold mb-8">Our Menu</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- @foreach ($produk as $pr)
                        <div class="bg-white flex flex-col justify-between p-6 rounded-lg shadow-lg">
                            <img src="{{ asset('storage/produks/' . basename($pr->foto)) }}"
                                class="w-full h-60 object-cover object-center mb-4 rounded">
                            <h3 class="text-xl font-semibold mb-2">{{ $pr->nama_produk }}</h3>
                            <p class="text-gray-700 mb-4">{{ $pr->deskripsi }}</p>
                            <span class="text-yellow-500 font-bold text-lg">Rp.
                                {{ number_format($pr->harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </section>
    </div>
@endsection
