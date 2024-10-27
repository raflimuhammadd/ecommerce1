@extends('admin.layout.app')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produk</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboardAdmin') }}">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('produk.create') }}" class="btn btn-outline-primary">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($produk as $pr)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pr->nama_produk }}</td>
                                        <td width="500">{{ $pr->deskripsi }}</td>
                                        <td> Rp. {{ number_format( $pr->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <img src="{{ asset('storage/produks/' . basename($pr->foto)) }}" width="100">
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/produk/edit/' . $pr->id) }}"><span
                                                    class="fa-fw select-all fas"></span></a>
                                            <a href="#" onclick="confirmDelete('{{ $pr->id }}')">
                                                <span class="fa-fw select-all fas"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Yakin ingin menghapus produk?',
                text: 'Produk akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    window.location.href = "{{ url('admin/produk/delete') }}/" + productId;
                }
            });
        }
        @if (session('success'))
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
