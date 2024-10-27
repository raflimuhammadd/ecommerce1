@extends('admin.layout.app')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12 text-center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Produk</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('produk.update', $produk->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama_produk">Nama Produk</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                                                name="nama_produk" value="{{ $produk->nama_produk }}" placeholder="Nama produk">
                                            @error('nama_produk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Tambahkan input untuk deskripsi dan harga -->
                                        <div class="col-md-4">
                                            <label for="deskripsi">Deskripsi</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                name="deskripsi" value="{{ $produk->deskripsi }}" placeholder="Deskripsi">
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="harga">Harga</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror"
                                                name="harga" value="{{ $produk->harga }}" placeholder="Harga">
                                            @error('harga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="foto">Foto</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <!-- Tambahkan input untuk upload foto -->
                                            <input type="file" class="image-resize-filepond" name="foto">
                                            @error('foto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                            <a href="{{ route('produk') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
            });
        @endif
    </script>
@endsection
