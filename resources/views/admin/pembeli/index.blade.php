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
                                <tr align="center">
                                    <th>No</th>
                                    <th>Kode Pembayaran</th>
                                    <th>Nama Pembeli</th>
                                    <th>No Telepon</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($transaksi as $tran)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $tran->id }}</td>
                                        <td>{{ $tran->nama }}</td>
                                        <td>{{ $tran->telp }}</td>
                                        @if ($tran->status == 'tidak')
                                            <td>Belum Lunas</td>
                                        @else
                                            <td>Lunas</td>
                                        @endif
                                        <td>
                                            Rp. {{ number_format( $tran->total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/pembeli/show/' . $tran->id) }}">
                                                <span class="fa-fw select-all fas"></span>
                                            </a>
                                            <a href="{{ url('admin/pembeli/edit/' . $tran->id) }}"><span
                                                class="fa-fw select-all fas"></span></a>
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
@endsection
