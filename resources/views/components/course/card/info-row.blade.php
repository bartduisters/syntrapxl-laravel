@props(['show_valid' => false])

<div {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}>
    <span class="w-[16px]">
        @isset($icon)
            {{ $icon }}
        @else
            @if ($show_valid)
                <x-icons.check class="block w-4 h-4" />
            @else
                <x-icons.close class="block w-[10px] h-[10px] ml-[3px]" />
            @endif
        @endisset
    </span>
    <span>{{ $slot }}</span>
</div>
