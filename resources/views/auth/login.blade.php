<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="w-full max-w-md">
            <!-- Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-600 text-white text-2xl shadow-lg shadow-emerald-200 mb-3">
                    🛒
                </div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Nusantara Shop</h1>
                <p class="text-gray-500 mt-1">Belanja enak, harga bersahabat 🇮🇩</p>
            </div>

            <!-- Card -->
            <div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl shadow-gray-200/60 ring-1 ring-gray-100 p-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-1">Selamat datang kembali 👋</h2>
                <p class="text-sm text-gray-500 mb-6">Masuk ke akun kamu untuk lanjut belanja.</p>

                @if (session('error'))
                    <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-xl" type="email" name="email"
                            :value="old('email')" required autofocus placeholder="nama@email.com"
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" value="Password" />
                            @if (Route::has('password.request'))
                                <a class="text-sm text-emerald-600 hover:text-emerald-800" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full rounded-xl" type="password"
                            name="password" required placeholder="••••••••" autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="remember" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                        <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 active:scale-[.98] transition text-white font-semibold shadow-lg shadow-emerald-200">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-3 my-6">
                    <div class="h-px bg-gray-200 flex-1"></div>
                    <span class="text-xs uppercase tracking-wider text-gray-400">atau</span>
                    <div class="h-px bg-gray-200 flex-1"></div>
                </div>

                <!-- Google button -->
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 py-3 rounded-xl bg-white ring-1 ring-gray-300 hover:bg-gray-50 active:scale-[.98] transition font-medium text-gray-700 shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15A11 11 0 0 0 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    Masuk dengan Google
                </a>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-800">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
