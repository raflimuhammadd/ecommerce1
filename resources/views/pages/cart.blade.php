@extends('layouts.app')

@section('front')
    <style>
        @layer utilities {

            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        }
    </style>

    <section class="bg-cover bg-center h-screen relative flex items-center text-white"
        style="background-image: url('https://images.unsplash.com/photo-1522335579687-9c718c5184d7?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di Yasir Health Store</h1>
            <p class="text-lg mb-8">Meyediakan kebutuhan kesehatan anda</p>
            <a href="{{ route('shop') }}"
                class="bg-yellow-500 text-gray-900 hover:bg-yellow-400 px-6 py-3 rounded-full text-lg font-semibold transition duration-300">View
                Menu</a>
        </div>
    </section>

    <section class="py-16 px-12">
        <div class="h-screen bg-gray-100 pt-20">
            <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
            <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="rounded-lg md:w-2/3">
                    @forelse ($keranjang as $item)
                        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                            <img src="{{ asset('storage/produks/' . basename($item->produk->foto)) }}" alt="product-image"
                                class="w-full rounded-lg sm:w-40" />
                            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                <div class="mt-5 sm:mt-0">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $item->produk->nama_produk }}</h2>
                                    <p class="mt-1 text-xs text-gray-700">{{ $item->produk->deskripsi }}</p>
                                </div>
                                <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                    <div class="flex items-center border-gray-100">
                                        <span
                                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                            onclick="adjustQuantity({{ $item->id }}, -1)">-</span>
                                        <input id="quantity-{{ $item->id }}"
                                            class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number"
                                            value="{{ $item->quantity }}" min="1" max="20"
                                            onchange="updateQuantity({{ $item->id }}, this.value)" disabled />
                                        <span
                                            class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                            onclick="adjustQuantity({{ $item->id }}, 1)">+</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <p class="text-sm">Rp.{{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                        <a class="text-red-500" onclick="deleteItem({{ $item->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Cart is empty</p>
                    @endforelse
                </div>

                <!-- Sub total -->
                <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                    <div class="mb-2 flex justify-between">
                        <p class="text-gray-700">Subtotal</p>
                        <p id="subtotal" class="text-gray-700">Rp. {{ number_format($subtotal, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-gray-700">PPN 10%</p>
                        <p id="ppn" class="text-gray-700">Rp. {{ number_format($ppn, 0, ',', '.') }}</p>
                    </div>
                    <hr class="my-4" />
                    <div class="flex justify-between">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p id="total" class="mb-1 text-lg font-bold">Rp. {{ number_format($total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $total }}" name="total">
                    <input id="tableNumberInput" type=" " name="no_telepon"
                        class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600"
                        placeholder="Masukkan No Telepon Anda">
                    <button id="checkoutButton"
                        class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600"
                        onclick="checkout()">Check out</button>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function updateQuantity(itemId, newQuantity) {
            console.log('Updating quantity for item:', itemId, 'New quantity:', newQuantity);

            $.ajax({
                url: `/keranjang/${itemId}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: newQuantity
                },
                success: function(response) {
                    updateCartItemUI(response);
                    updateSubtotal(response.subtotal);
                },
                error: function(error) {
                    console.error('Error updating quantity:', error.responseText);
                }
            });
        }

        function adjustQuantity(itemId, adjustment) {
            console.log('Adjusting quantity for item ' + itemId + ' by ' + adjustment);

            var inputField = $(`#quantity-${itemId}`);
            var currentQuantity = parseInt(inputField.val());
            var newQuantity = currentQuantity + adjustment;

            // Make sure the new quantity is at least 1
            newQuantity = Math.max(newQuantity, 1);

            console.log('New quantity for item ' + itemId + ': ' + newQuantity);

            // Update the input field value
            inputField.val(newQuantity);

            // Update the quantity via the updateQuantity function
            updateQuantity(itemId, newQuantity);
            window.location.reload();
        }

        function deleteItem(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/keranjang/${itemId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            updateCartItemUI(response);
                            updateSubtotal(response.subtotal);

                        },
                        error: function(error) {
                            console.error('Error deleting item:', error.responseText);
                        }
                    });
                    window.location.reload();
                }
            });
        }

        function updateCartItemUI(response) {
            // You can update the UI for the specific item using the response data
            console.log('Updating UI for item:', response);
        }

        function updateSubtotal(newSubtotal) {
            // Update the subtotal in the UI
            $('#subtotal').text('Rp. ' + newSubtotal.toLocaleString('en-ID'));
        }

        function checkout() {
            var cartIsEmpty = {{ $keranjang->isEmpty() ? 'true' : 'false' }};
            var nomorTelepon = $('#tableNumberInput').val();
            var totalHarga = {{ $total }};

            // Periksa apakah nomor meja telah dimasukkan
            if (!nomorTelepon) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please enter your number telepon',
                    text: 'You need to enter the table number before checking out.'
                });
                return;
            }

            if (cartIsEmpty) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Your cart is empty',
                    text: 'Please add items to your cart before checking out.'
                });
            } else {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Do you want to proceed with the checkout?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, checkout!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Set nilai elemen formulir sebelum menampilkan Swal alert
                        $('#tableNumberInput').val(nomorTelepon);
                        $.ajax({
                            url: '/checkout',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                _token: '{{ csrf_token() }}',
                                total: totalHarga,
                                no_telepon: nomorTelepon,
                            }),
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Checkout Successful',
                                    text: response.message,
                                    didClose: function() {
                                        window.location.replace('/generatePDF/' + response
                                            .transaction_id);
                                    }
                                });
                            },
                            error: function(error) {
                                console.error('Error during checkout:', error.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Checkout Failed',
                                    text: 'An error occurred during checkout. Please try again.'
                                });
                            }
                        });
                    }
                });
            }
        }
    </script>
@endsection
