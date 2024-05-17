@props(['type'])

@if ($type === 'new')
    <span style="background-image: url('https://www.syntrapxl.be/themes/custom/sassy/images/new.png');"
        class="absolute top-[-1px] right-[-1px] w-[47px] h-[47px] bg-cover">
    </span>
@endif
@if ($type === 'bottleneck')
    <span style="background-image: url('https://www.syntrapxl.be/themes/custom/sassy/images/bottleneck.png');"
        class="absolute top-[-1px] right-[-1px] w-[97px] h-[97px] bg-cover">
    </span>
@endif
