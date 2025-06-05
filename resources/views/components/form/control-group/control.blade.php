@props([
    'type' => 'text',
    'name' => '',
])

@switch($type)
    @case('hidden')
    @case('text')

    @case('email')
    @case('password')

    @case('number')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <input
                v-bind="field"
                type="{{ $type }}"
                name="{{ $name }}"
                :class="[errors.length ? 'border !border-danger hover:border-danger' : '']"
                {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base font-normal bg-background text-on-background/90 transition-all hover:border-on-background/10 hover:border-on-background/10 max-sm:px-4 max-md:py-2 max-sm:text-sm']) }}
            >
        </v-field>
    @break

    @case('file')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                :class="[errors.length ? 'border !border-danger hover:border-danger' : '']"
                {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base text-on-background/90 transition-all hover:border-on-background/10 hover:border-on-background/10 max-sm:px-4 max-md:py-2 max-sm:text-sm']) }}
            >
        </v-field>
    @break

    @case('color')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->except('class') }}
            name="{{ $name }}"
        >
            <input
                v-bind="field"
                type="{{ $type }}"
                :class="[errors.length ? 'border !border-danger' : '']"
                {{ $attributes->except(['value'])->merge(['class' => 'rounded-lg-md w-full appearance-none border text-base text-on-background/90 transition-all hover:border-on-background/10 ']) }}
            >
        </v-field>
    @break

    @case('textarea')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <textarea
                v-bind="field"
                type="{{ $type }}"
                name="{{ $name }}"
                :class="[errors.length ? 'border !border-danger hover:border-danger' : '']"
                {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base font-normal bg-background text-on-background/90 transition-all hover:border-on-background/10 focus:border-on-background/10']) }}
            >
            </textarea>

            @if ($attributes->get('tinymce', false) || $attributes->get(':tinymce', false))
                <x-shop::tinymce
                    :selector="'textarea#' . $attributes->get('id')"
                    :prompt="stripcslashes($attributes->get('prompt', ''))"
                    ::field="field"
                >
                </x-shop::tinymce>
            @endif
        </v-field>
    @break

    @case('date')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <x-shop::flat-picker.date {{ $attributes }}>
                <input
                    v-bind="field"
                    name="{{ $name }}"
                    :class="[errors.length ? 'border !border-danger hover:border-danger' : '']"
                    {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base bg-background text-on-background/90  transition-all hover:border-on-background/10 hover:border-on-background/10 max-sm:px-4 max-md:py-2 max-sm:text-sm']) }}
                    autocomplete="off"
                >
            </x-shop::flat-picker.date>
        </v-field>
    @break

    @case('datetime')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <x-shop::flat-picker.datetime>
                <input
                    v-bind="field"
                    name="{{ $name }}"
                    :class="[errors.length ? 'border !border-danger hover:border-danger' : '']"
                    {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'mb-1.5 w-full rounded-lg border px-5 py-3 text-base bg-background text-on-background/90  transition-all hover:border-on-background/10 hover:border-on-background/10 max-sm:px-4 max-md:py-2 max-sm:text-sm']) }}
                    autocomplete="off"
                >
            </x-shop::flat-picker.datetime>
        </v-field>
    @break

    @case('select')
        <v-field
            v-slot="{ field, errors }"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label']) }}
            name="{{ $name }}"
        >
            <select
                v-bind="field"
                name="{{ $name }}"
                :class="[errors.length ? 'border !border-danger' : '']"
                {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label'])->merge(['class' => 'custom-select mb-1.5 w-full rounded-lg border bg-background px-5 py-3 text-base text-on-background/90  transition-all hover:border-on-background/10 focus-visible:outline-none max-md:py-2 max-sm:px-4 max-sm:text-sm']) }}
            >
                {{ $slot }}
            </select>
        </v-field>
    @break

    @case('multiselect')
        <v-field
            v-slot="{ value }"
            as="select"
            :class="[errors && errors['{{ $name }}'] ? 'border !border-danger' : '']"
            {{ $attributes->except([])->merge(['class' => 'mb-1.5 w-full rounded-lg border bg-background px-5 py-3 text-base text-on-background/90  transition-all hover:border-on-background/10 focus-visible:outline-none max-md:py-2 max-sm:px-4 max-sm:text-sm']) }}
            name="{{ $name }}"
            multiple
        >
            {{ $slot }}
        </v-field>
    @break

    @case('checkbox')
        <v-field
            v-slot="{ field }"
            type="checkbox"
            class="hidden"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
            name="{{ $name }}"
        >
            <input
                v-bind="field"
                type="checkbox"
                class="peer sr-only"
                {{ $attributes->except(['rules', 'label', ':label', 'key', ':key']) }}
                name="{{ $name }}"
            />
        </v-field>

        <label class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl peer-checked:text-navyBlue"
            {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
        >
        </label>
    @break

    @case('radio')
        <v-field
            v-slot="{ field }"
            type="radio"
            class="hidden"
            {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
            name="{{ $name }}"
        >
            <input
                v-bind="field"
                type="radio"
                name="{{ $name }}"
                class="peer sr-only"
                {{ $attributes->except(['rules', 'label', ':label', 'key', ':key']) }}
            />
        </v-field>

        <label class="icon-radio-unselect peer-checked:icon-radio-select cursor-pointer text-2xl peer-checked:text-navyBlue"
            {{ $attributes->except(['value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
        >
        </label>
    @break

    @case('switch')
        <label class="relative inline-flex cursor-pointer items-center">
            <v-field
                v-slot="{ field }"
                type="checkbox"
                class="hidden"
                {{ $attributes->only(['name', ':name', 'value', ':value', 'v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
                name="{{ $name }}"
            >
                <input
                    id="{{ $name }}"
                    v-bind="field"
                    type="checkbox"
                    name="{{ $name }}"
                    class="peer sr-only"
                    {{ $attributes->except(['v-model', 'rules', ':rules', 'label', ':label', 'key', ':key']) }}
                />
            </v-field>

            <label
                class="rounded-lg-full after:rounded-lg-full peer h-5 w-9 cursor-pointer bg-surface-alt after:absolute after:left-0.5 after:top-0.5 after:h-4 after:w-4 after:border after:border-on-background/10 after:bg-background after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-checked:after:border-on-background peer-focus:outline-none peer-focus:ring-blue-300"
                for="{{ $name }}"
            ></label>
        </label>
    @break

    @case('image')
        <x-shop::media
            ::class="[errors && errors['{{ $name }}'] ? 'border !border-danger' : '']"
            {{ $attributes }}
            name="{{ $name }}"
        />
    @break

    @case('custom')
        <v-field {{ $attributes }}>
            {{ $slot }}
        </v-field>
    @endswitch
