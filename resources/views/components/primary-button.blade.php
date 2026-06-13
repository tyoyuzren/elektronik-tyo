<button {{ $attributes->merge(['type' => 'submit', 'class' => 'brutal-btn-primary']) }}>
    {{ $slot }}
</button>
