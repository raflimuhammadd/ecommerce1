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
                            <form class="form form-horizontal" method="POST" action="{{ route('updateTransaksi', $transaksi->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama_produk">Status Pembayaran</label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="lunas" @if($transaksi->status == 'lunas') selected @endif>Lunas</option>
                                                <option value="tidak" @if($transaksi->status == 'tidak') selected @endif>Belum Lunas</option>
                                            </select>
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
