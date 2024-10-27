@extends('admin.layout.app')
@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12 text-center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('produk.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Nama Produk</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" id="first-name-horizontal"
                                                class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk"
                                                placeholder="Nama produk">
                                            @error('nama_produk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Deskripsi</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" id="first-name-horizontal"
                                                class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                                placeholder="Deskripsi">
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Harga</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="number" id="first-name-horizontal"
                                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                                placeholder="Harga">
                                            @error('harga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-5">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <input type="file" class="image-resize-filepond" name="foto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button name="submit" type="submit"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{ route('produk') }}" class="btn btn-light-secondary me-1 mb-1">
                                                Cancel</a>
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
@endsection
