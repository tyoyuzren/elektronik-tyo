<x-guest-layout>
    <div class="space-y-6" x-data="savedAccounts()">
        {{-- Header --}}
        <div class="text-center">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary/15 to-accent-blue/5 border border-primary/20 flex items-center justify-center mx-auto mb-4">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 28px; color: var(--color-text);">
                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold" style="color: var(--color-text);">Selamat Datang</h1>
            <p class="text-sm mt-1" style="color: var(--color-text-muted);">Silakan masuk ke akun Anda</p>
        </div>

        {{-- Saved Accounts --}}
        <template x-if="accounts.length > 0">
            <div>
                <p class="label mb-2">Akun tersimpan</p>
                <div class="flex flex-wrap gap-2">
                    <template x-for="(email, index) in accounts" :key="index">
                        <button @click="selectAccount(email)"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all duration-150 hover:scale-[1.02] group"
                                style="background-color: var(--color-surface); border: 1px solid var(--color-border); color: var(--color-text-muted);">
                            <i class="ph ph-user text-sm" style="color: var(--color-text-dim);"></i>
                            <span x-text="email" class="max-w-[140px] truncate"></span>
                            <span @click.stop="removeAccount(email)"
                                  class="opacity-0 group-hover:opacity-100 transition-opacity"
                                  style="color: var(--color-text-dim);">
                                <i class="ph ph-x text-xs"></i>
                            </span>
                        </button>
                    </template>
                </div>
            </div>
        </template>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="label">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="ph ph-envelope-simple text-base" style="color: var(--color-text-dim);"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                           class="input pl-10"
                           placeholder="Masukkan email Anda"
                           style="background-color: var(--color-surface);">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="label">Kata Sandi</label>
                <div class="relative" x-data="{ show: false }">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="ph ph-lock text-base" style="color: var(--color-text-dim);"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="input pl-10 pr-10"
                           placeholder="Masukkan kata sandi"
                           style="background-color: var(--color-surface);">
                    <button type="button" @click="show = !show; $el.closest('.relative').querySelector('#password').type = show ? 'text' : 'password'" class="absolute inset-y-0 right-0 pr-3.5 flex items-center" style="color: var(--color-text-dim);">
                        <i class="ph text-base" :class="show ? 'ph-eye' : 'ph-eye-slash'"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="w-4 h-4 rounded-md border transition-colors"
                           style="background-color: var(--color-surface); border-color: var(--color-border); accent-color: #6C5CE7;">
                    <span class="text-xs font-medium" style="color: var(--color-text-muted);">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold transition-colors hover:underline" style="color: var(--color-text-muted);">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" onclick="setTimeout(() => { let e=document.getElementById('email'); if(e) { let a=JSON.parse(localStorage.getItem('saved_accounts')||'[]'); a=a.filter(x=>x!==e.value); a.unshift(e.value); localStorage.setItem('saved_accounts',JSON.stringify(a.slice(0,5))); } }, 100)"
                    class="btn-primary w-full !py-3 text-sm relative overflow-hidden group">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    <i class="ph ph-sign-in text-base"></i>
                    Masuk
                </span>
                <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
        </form>

        {{-- Register Link --}}
        @if (Route::has('register'))
            <div class="text-center pt-2">
                <p class="text-sm" style="color: var(--color-text-muted);">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold transition-colors hover:underline" style="color: #8B7CFF;">
                        Daftar
                    </a>
                </p>
            </div>
        @endif
    </div>
</x-guest-layout>
