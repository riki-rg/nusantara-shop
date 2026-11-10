<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online') — Nusantara Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-xl font-bold text-emerald-700 whitespace-nowrap">🌿 Nusantara Shop</a>
            <form method="GET" action="{{ route('products.index') }}" class="flex-1 max-w-md hidden sm:block">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari di Nusantara Shop..."
                       class="w-full px-4 py-2 border rounded-full text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </form>
            <nav class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('wishlist.index') }}" class="hover:text-emerald-700" title="Wishlist">❤️</a>
                    <a href="{{ route('orders.index') }}" class="hover:text-emerald-700">Pesanan</a>
                    <a href="{{ route('cart.index') }}" class="hover:text-emerald-700">🛒 Keranjang</a>
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-700 font-semibold">⚙️ Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-500 hover:text-red-600">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-emerald-700">Masuk</a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-emerald-100 text-emerald-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t mt-8">
        <div class="max-w-6xl mx-auto px-4 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Nusantara Shop — Dibangun dengan Laravel
        </div>
    </footer>
</body>
</html>
