<div {{ $attributes->merge(['class' => 'flex flex-col flex-wrap justify-between md:flex-row']) }}>
    <div class="md:w-[63%]">
        {{ $left }}
    </div>
    <div class="md:w-[31%]">
        {{ $right }}
    </div>
</div>
