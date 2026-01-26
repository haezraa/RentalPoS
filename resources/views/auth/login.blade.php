<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rizki Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex overflow-hidden">

    <div class="hidden lg:flex w-1/2 bg-[#2251a5] relative overflow-hidden flex-col justify-between p-12 text-white">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-black/20 blur-3xl"></div>

        <div class="relative z-10 flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <span class="font-bold tracking-widest text-sm uppercase text-blue-200">System v1.0</span>
        </div>

        <div class="relative z-10 mb-20">
            <h1 class="text-5xl font-black leading-tight mb-4">
                KELOLA RENTAL <br> LEBIH MUDAH.
            </h1>
            <p class="text-blue-100 text-lg max-w-md leading-relaxed">
                Sistem manajemen kasir, stok, dan laporan terintegrasi untuk Rizki Rental PS.
            </p>
        </div>

        <div class="relative z-10 text-xs text-blue-300">
            &copy; {{ date('Y') }} Rizki Rental PS. All rights reserved.
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-6 relative">

        <div class="w-full max-w-md">
            <div class="lg:hidden text-center mb-8">
                <h2 class="text-2xl font-black text-[#2251a5]">RIZKI RENTAL</h2>
                <p class="text-gray-500 text-sm">Masuk untuk melanjutkan</p>
            </div>

            <div class="text-left mb-10">
                <h2 class="text-3xl font-black text-gray-800 mb-2">Selamat Datang 👋</h2>
                <p class="text-gray-500">Silakan masukkan email dan password admin.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-bold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Email atau password salah.</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2251a5] focus:border-[#2251a5] transition outline-none font-semibold text-gray-700 placeholder-gray-400"
                            placeholder="admin@rental.com">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2251a5] focus:border-[#2251a5] transition outline-none font-semibold text-gray-700 placeholder-gray-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-[#2251a5] border-gray-300 rounded focus:ring-[#2251a5]">
                        <span class="text-sm text-gray-600 font-medium">Ingat Saya</span>
                    </label>
                    </div>

                <button type="submit"
                    class="w-full bg-[#2251a5] hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <span>MASUK APLIKASI</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-gray-400">
                Aplikasi POS & Rental Management v1.0
            </p>
        </div>
    </div>

</body>
</html>
