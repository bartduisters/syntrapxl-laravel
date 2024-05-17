@props(['course'])

<div
    class="border border-gray-200 dark:border-gray-700 pt-[28px] pb-[60px] pl-[72px] bg-white dark:bg-gray-800 relative">
    @if ($course->is_new)
        <x-course.card.banner type="new" />
    @endif
    @if ($course->is_knelpuntberoep)
        <x-course.card.banner type="bottleneck" />
    @endif
    <div class="absolute left-0 flex items-center justify-center w-12 h-12 arrow-right bg-syntra top-7">
        <x-icons.arrow-right class="block w-5 h-5 mx-auto" />
    </div>

    <x-course.card.row class="pb-4">
        <x-slot:left>
            <h2 class="text-lg font-bold"> {{ $course->title }} </h2>
        </x-slot:left>
        <x-slot:right>
            @if ($course->price_incl)
                <x-course.card.price-info :incl="$course->price_incl" :excl="$course->price_excl" />
            @else
                Prijs wordt binnenkort toegevoegd
            @endif
        </x-slot:right>
    </x-course.card.row>
    <x-course.card.row>
        <x-slot:left>
            {{ $course->teaser }}
        </x-slot:left>
        <x-slot:right>
            <div class="flex flex-col">
                <x-course.card.info-row :show_valid="$course->has_kmo">
                    KMO-portefeuille
                </x-course.card.info-row>
                <x-course.card.info-row :show_valid="$course->has_cheques">
                    Opleidingscheques
                </x-course.card.info-row>
                @if ($course->has_location)
                    <x-course.card.info-row class="mt-4">
                        <x-slot:icon>
                            <x-icons.location class="block w-4 h-4" />
                        </x-slot:icon>
                        {{ $course->locations_string }}
                    </x-course.card.info-row>
                @endif
            </div>
        </x-slot:right>
    </x-course.card.row>
</div>
