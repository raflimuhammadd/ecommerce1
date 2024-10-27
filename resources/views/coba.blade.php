<div class="row">
    @foreach ($transaksi as $trans)
        <div class="col-md-3">
            <div class="osahan-account-page-left shadow-sm bg-white h-100">
                <div class="border-bottom p-4">
                    <div class="osahan-user text-center">
                        <div class="osahan-user-media">
                            <img class="mb-3 rounded-pill shadow-sm mt-1"
                                src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="gurdeep singh osahan">
                            <div class="osahan-user-media-body">
                                <h6 class="mb-2">{{ $trans->nama }}</h6>
                                <p class="mb-1">{{ $trans->telp }}</p>
                                <p>{{ $trans->email }}</p>
                                <p>Total Harga Rp. {{ number_format($trans->total, 0, ',', '.') }}</p>
                                @if ($trans->status == 'tidak')
                                <p>Paid/Unpaid : Unpaid</p>
                                @else
                                <p>Paid/Unpaid : Paid</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-md-9">
        <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  active show" id="favourites" role="tabpanel"
                    aria-labelledby="favourites-tab">
                    <h4 class="font-weight-bold mt-0 mb-4">Detail</h4>
                    <div class="row">
                        @foreach ($detail as $det)
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div
                                    class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">

                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1">
                                                <h3 class="text-black">
                                                    {{ $det->nama_produk }}
                                                </h3>
                                            </h6>
                                            <p class="text-gray mb-3">Quantity {{ $det->quantity }}</p>
                                            <p class="text-gray mb-3">Harga Produk Rp.
                                                {{ number_format($det->harga, 0, ',', '.') }}</p>
                                            {{-- <p class="text-gray mb-3 time"><span
                                                    class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                        class="icofont-wall-clock"></i> 15–30 min</span> <span
                                                    class="float-right text-black-50"> $350 FOR TWO</span></p> --}}
                                        </div>
                                        {{-- <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small> Use Coupon
                                                OSAHAN50</small>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 text-center load-more">
                            <a href="{{ url('admin/transaksi') }}" class="btn btn-primary" type="button">
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                </span> Keluar...
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>