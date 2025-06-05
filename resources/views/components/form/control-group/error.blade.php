@props([
    'name' => null,
    'controlName' => null,
])

<v-error-message
    v-slot="{ message }"
    {{ $attributes }}
    name="{{ $name ?? $controlName }}"
>
    <p {{ $attributes->merge(['class' => 'text-danger text-xs italic']) }} v-text="message">
    </p>
</v-error-message>
