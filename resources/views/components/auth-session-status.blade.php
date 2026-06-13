@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-brutal-green']) }}>
        {{ $status }}
    </div>
@endif
