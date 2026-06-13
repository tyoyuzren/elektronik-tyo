<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-heading font-bold text-2xl text-brutal-text">Profile</h1>
            <p class="text-brutal-muted text-sm mt-1">Pengaturan akun</p>
        </div>

        <div class="space-y-6 max-w-2xl">
            <div class="brutal-card">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="brutal-card">
                @include('profile.partials.update-password-form')
            </div>

            <div class="brutal-card">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
