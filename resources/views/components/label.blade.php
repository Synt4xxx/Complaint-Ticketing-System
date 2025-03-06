<label {{ $attributes->merge(['class' => 'block text-gray-700 font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
