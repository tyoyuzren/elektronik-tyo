<button {{ $attributes->merge(['type' => 'submit', 'class' => 'brutal-btn-red']) }}>
    {{ $slot }}
</button>
