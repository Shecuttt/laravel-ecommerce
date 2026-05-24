@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-foreground']) }}>
    {{ $value ?? $slot }}
</label>
