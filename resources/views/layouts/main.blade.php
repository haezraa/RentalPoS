<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#2251a5',
                        'brand-dark': '#1a1a1a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Sedikit tweak biar scrollbar gak kaku */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Scrollbar Tipis & Ganteng */
        .scrollbar-hide::-webkit-scrollbar {
            width: 6px;
            /* Lebar tipis */
        }

        .scrollbar-hide::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Warna track */
            border-radius: 4px;
        }

        .scrollbar-hide::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            /* Warna handle */
            border-radius: 4px;
        }

        .scrollbar-hide::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
            /* Warna pas di-hover */
        }
    </style>
</head>

<body class="bg-gray-100 text-brand-dark font-sans">

    <div class="flex h-screen overflow-hidden bg-gray-100">

        <aside class="w-64 bg-brand-blue text-white flex flex-col shadow-2xl relative z-10">

            <div class="h-20 flex items-center justify-center border-b border-white/10">
                <div class="text-center">
                    <div class="text-3xl mb-1 drop-shadow-md">🎮</div>
                    <h1 class="text-lg font-black tracking-wider text-white drop-shadow-sm">RENTAL PS POS</h1>
                </div>
            </div>

            <div class="p-4 border-b border-white/10 bg-white/5">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center font-bold text-white shadow-sm">
                        A
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Admin</p>
                        <a href="#" class="text-xs text-blue-200 hover:text-white transition">Edit Profile </a>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 font-semibold">
                <a href="{{ route('home') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition transform {{ Request::is('/') ? 'bg-white/20 text-white shadow-inner scale-[1.02]' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span>Home</span>
                </a>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition transform {{ Request::is('rental') ? 'bg-white/20 text-white shadow-inner scale-[1.02]' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Rental Area</span>
                </a>

                <a href="{{ route('fnb.cashier') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition transform {{ Request::is('fnb/order') ? 'bg-white/20 text-white shadow-inner scale-[1.02]' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>FnB Order</span>
                </a>

                <a href="{{ route('fnb.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition transform {{ Request::is('fnb') ? 'bg-white/20 text-white shadow-inner scale-[1.02]' : 'text-blue-200 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>Stok Gudang</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">

            <header
                class="h-20 bg-white flex justify-between items-center px-8 shadow-sm z-10 border-b border-gray-200">
                <h2 class="text-2xl font-black text-brand-dark">
                    @yield('judul_halaman')
                </h2>

                <div>
                    @yield('header_actions')
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 bg-gray-100">
                @yield('konten')
            </div>

        </main>
    </div>

</body>

</html>
