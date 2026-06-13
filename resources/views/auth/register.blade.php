<x-guest-layout>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="text-center">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-green/15 to-accent-cyan/5 border border-accent-green/20 flex items-center justify-center mx-auto mb-4">
                <i class="ph ph-user-plus text-2xl text-accent-green"></i>
            </div>
            <h1 class="text-xl font-bold" style="color: var(--color-text);">Buat Akun Baru</h1>
            <p class="text-sm mt-1" style="color: var(--color-text-muted);">Daftar untuk memulai</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="label">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="ph ph-user text-base" style="color: var(--color-text-dim);"></i>
                    </div>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                           class="input pl-10"
                           placeholder="Masukkan nama Anda"
                           style="background-color: var(--color-surface);">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="label">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="ph ph-envelope-simple text-base" style="color: var(--color-text-dim);"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
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
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="input pl-10 pr-10"
                           placeholder="Buat kata sandi"
                           style="background-color: var(--color-surface);">
                    <button type="button" @click="show = !show; $el.closest('.relative').querySelector('#password').type = show ? 'text' : 'password'" class="absolute inset-y-0 right-0 pr-3.5 flex items-center" style="color: var(--color-text-dim);">
                        <i class="ph text-base" :class="show ? 'ph-eye' : 'ph-eye-slash'"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="label">Konfirmasi Kata Sandi</label>
                <div class="relative" x-data="{ show: false }">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="ph ph-lock text-base" style="color: var(--color-text-dim);"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="input pl-10 pr-10"
                           placeholder="Ulangi kata sandi"
                           style="background-color: var(--color-surface);">
                    <button type="button" @click="show = !show; $el.closest('.relative').querySelector('#password_confirmation').type = show ? 'text' : 'password'" class="absolute inset-y-0 right-0 pr-3.5 flex items-center" style="color: var(--color-text-dim);">
                        <i class="ph text-base" :class="show ? 'ph-eye' : 'ph-eye-slash'"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" onclick="setTimeout(() => { let e=document.getElementById('email'); if(e) { let a=JSON.parse(localStorage.getItem('saved_accounts')||'[]'); a=a.filter(x=>x!==e.value); a.unshift(e.value); localStorage.setItem('saved_accounts',JSON.stringify(a.slice(0,5))); } }, 100)"
                    class="btn-primary w-full !py-3 text-sm relative overflow-hidden group">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    <i class="ph ph-user-plus text-base"></i>
                    Daftar
                </span>
                <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
        </form>

        {{-- Login Link --}}
        <div class="text-center pt-2">
            <p class="text-sm" style="color: var(--color-text-muted);">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold transition-colors hover:underline" style="color: #8B7CFF;">
                    Masuk
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
