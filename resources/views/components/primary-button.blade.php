@props([
    'type' => 'submit',
    'disabled' => false,
])

<button
    {{ $attributes
        ->merge([
            'type' => $type,
            'class' =>
                'inline-flex items-center justify-center gap-2
                 px-4 py-2 rounded-lg font-semibold text-sm
                 bg-indigo-600 text-white shadow-sm
                 hover:bg-indigo-700 active:bg-indigo-800
                 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2
                 disabled:opacity-50 disabled:cursor-not-allowed'
        ])
    }}
    @disabled($disabled)
>
    {{ $slot }}

    {{-- Spinner opcional para Livewire --}}
    @if(str_contains($attributes->get('class', ''), 'wire:'))
        <svg wire:loading wire:target="{{ $attributes->whereStartsWith('wire:click')->first() ? '': null }}"
             class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    @endif
</button>