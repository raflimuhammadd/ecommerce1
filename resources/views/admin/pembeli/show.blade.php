@extends('admin.layout.app')
@section('content')
    <div class="">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('storage/profile/profile.png') }}"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">

                            </img>
                            <h1 class="text-xl font-bold">
                                @if ($transaksi->first()->nama == null)
                                    {{ $transaksi->first()->email }}
                                @else
                                    {{ $transaksi->first()->nama }}
                                @endif
                            </h1>
                            <p class="text-gray-700">No Telepon = {{ $transaksi->first()->no_telepon }}</p>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Transaksi</span>
                            <ul>
                                <li class="mb-2">
                                    @if ($transaksi->first()->status == 'tidak')
                                        <td>Belum Lunas</td>
                                    @else
                                        <td>Lunas</td>
                                    @endif
                                </li>
                                <li class="mb-2">Total : Rp. {{ number_format($transaksi->first()->total, 0, ',', '.') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mt-6 mb-4">Detail</h2>
                        <div class="mb-6">
                            @foreach ($detail as $det)
                                <div class="flex justify-between flex-wrap gap-2 w-full">
                                    <span class="text-gray-700 font-bold">{{ $det->nama_produk }}</span>
                                    <p>
                                        <span class="text-gray-700 mr-2">Quantity {{ $det->quantity }}</span>
                                    </p>
                                </div>
                                <div class="flex justify-between flex-wrap gap-2 w-full">
                                    <span class="text-gray-700">Harga Satuan : Rp.
                                        {{ number_format($det->harga, 0, ',', '.') }}</span>
                                    <p>
                                        <span class="text-gray-700 mr-2">Total Harga : Rp.
                                            {{ number_format($det->harga * $det->quantity, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                                <p class="mt-2">
                                    {{ $det->deskripsi }}
                                </p>
                            @endforeach
                        </div>
                        <a href="{{ route('pembeli') }}" class="btn btn-light-secondary me-1 mb-1">
                            Kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
