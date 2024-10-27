<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin//extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/js/app.js')
</head>

<body class = "bg-white">
    <nav class="bg-gray-800 text-white relative w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8"
        aria-label="Global">
        <div class="flex items-center justify-between">
            <a class="flex-none text-xl font-semibold dark:text-grey" href="#" aria-label="Brand">Yasir Health Store</a>
            <div class="md:hidden">
                <button type="button"
                    class="hs-collapse-toggle w-8 h-8 flex justify-center items-center text-sm font-semibold rounded-full border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation"
                    aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="navbar-collapse-with-animation"
            class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
            <div
                class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:items-center md:justify-end md:gap-y-0 md:gap-x-7 md:mt-0 md:ps-7">
                <a class="font-medium text-white md:py-6 dark:text-white" href="{{ url('/') }}"
                    aria-current="page">Home</a>
                @if (Route::has('login'))
                    @auth
                        <a class="font-medium text-black hover:text-black md:py-6 dark:text-white dark:hover:text-gray-500"
                            href="{{ route('shop') }}">Shop</a>
                    @else
                        <div></div>
                    @endauth
                @endif
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a class="font-medium text-gray-500 hover:text-black md:py-6 dark:text-white dark:hover:text-gray-500"
                            href="{{ route('dashboardAdmin') }}">Dashboard</a>
                    @endif
                    <div
                        class="flex items-center gap-x-2 font-medium text-white hover:text-blue-600 md:border-s md:border-gray-300 md:my-6 md:ps-6 dark:border-gray-700 dark:text-white dark:hover:text-blue-500">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        @if (Auth::user()->name == null)
                            <span>{{ Auth::user()->email }}</span>
                        @else
                            <span>{{ Auth::user()->name }}</span>
                        @endif
                    </div>
                @endauth

                @if (Route::has('login'))
                    @auth
                        <a class="font-medium text-gray-500 hover:text-black md:py-6 dark:text-white dark:hover:text-gray-500"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('frmlogout').submit();">
                            Logout
                        </a>
                        <a class="font-medium text-black hover:text-black md:py-6 dark:text-white dark:hover:text-gray-500"
                            href="{{ route('keranjang.index') }}"><span class="fa-fw select-all fas"></span></a>
                        <form id="frmlogout" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    @else
                        <a class="font-medium text-white hover:text-grey-800 md:py-6 dark:text-white dark:hover:text-gray-500"
                            href="{{ route('login') }}">
                            Login
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    @yield('front')
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">About Us</h2>
            <p class="text-lg mb-8">Follow us on social media:</p>

            <div class="flex justify-center mb-6">
                <!-- Instagram -->
                <a href="" class="mr-6">
                    <img src="{{ asset('gambar/instagram.png') }}" alt="Instagram" class="w-8 h-8">
                </a>
                <!-- WhatsApp -->
                <a href="" target="_blank"class="mr-6">
                    <img src="{{ asset('gambar/whatsapp.png') }}" alt="WhatsApp" class="w-8 h-8">
                </a>
                <!-- Twitter -->
                <a href="" class="mr-6">
                    <img src="{{ asset('gambar/Twitter.png') }}" alt="Twitter" class="w-8 h-8">
                </a>
            </div>

            <p class="text-lg">Kami percaya bahwa kesehatan bukan sekadar tujuan, tapi sebuah perjalanan. Dengan produk-produk terbaik dan proses pemilihan yang teliti, kami memberikan Anda solusi kesehatan yang dapat diandalkan, membantu Anda menjelajahi dunia kesejahteraan dengan lebih baik..</p>
        </div>
    </section>

    <footer class="bg-gray-800 py-8 text-white text-center">
        <div class="container mx-auto">
            &copy; 2023 Yasir Health Store. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="../../node_modules/preline/dist/preline.js"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <script>
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 3,
            focusAt: 'center',
            breakpoints: {
                768: {
                    perView: 1
                }
            }
        }).mount();
    </script>
</body>

</html>
