<x-app-layout>

    <div class="flex">

        <div class="w-full min-h-screen p-10 bg-white max-w-80 dark:bg-gray-800">
            hier de filters
        </div>

        <div class="text-gray-900 dark:text-gray-100 md:px-[8.3%]">

            <div class="my-11">

                <span class="text-xl font-bold"> {{ $courses->total() }} </span>
                opleidingen gevonden
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($courses as $course)
                    <?php
                    $has_kmo = $course->savings->contains('name', 'kmo');
                    $has_cheques = $course->savings->contains('name', 'cheques');
                    $has_location = $course->startDates->count() > 0;
                    $unique_start_date_locations = $course->startDates->unique('location_id');
                    
                    $is_new = $course->specialProperties->contains('name', 'Nieuw');
                    $is_knelpuntberoep = $course->specialProperties->contains('name', 'Knelpuntberoep');
                    ?>
                    <div
                        class="border border-gray-200 dark:border-gray-700 pt-[28px] pb-[60px] pl-[72px] bg-white dark:bg-gray-800 relative">
                        @if ($is_new)
                            <span
                                style="background-image: url('https://www.syntrapxl.be/themes/custom/sassy/images/new.png');"
                                class="absolute top-[-1px] right-[-1px] w-[47px] h-[47px] bg-cover">
                            </span>
                        @endif
                        @if ($is_knelpuntberoep)
                            <span
                                style="background-image: url('https://www.syntrapxl.be/themes/custom/sassy/images/bottleneck.png');"
                                class="absolute top-[-1px] right-[-1px] w-[97px] h-[97px] bg-cover">
                            </span>
                        @endif
                        <div
                            class="absolute left-0 flex items-center justify-center w-12 h-12 arrow-right bg-syntra top-7">
                            <x-icons.arrow-right class="block w-5 h-5 mx-auto" />
                        </div>
                        <div class="flex flex-col flex-wrap justify-between pb-4 md:flex-row">
                            <h2 class="text-lg font-bold md:w-[63%]"> {{ $course->title }} </h2>
                            <div class="md:w-[31%] flex items-center gap-4">
                                <span>
                                    <x-icons.check-filled class="block w-5 h-5" />
                                </span>
                                <div>
                                    <div class="font-bold text-syntra"> € {{ number_format($course->price_incl, 2) }}
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-200"> €
                                        {{ number_format($course->price_excl, 2) }} </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col flex-wrap justify-between md:flex-row">
                            <p class="md:w-[63%]"> {{ $course->teaser }} </p>
                            <div class="md:w-[31%] flex flex-col">
                                <div class="flex items-center gap-4">
                                    <span class="w-[16px]">
                                        @if ($has_kmo)
                                            <x-icons.check class="block w-4 h-4" />
                                        @else
                                            <x-icons.close class="block w-[10px] h-[10px] ml-[3px]" />
                                        @endif
                                    </span> <span>KMO-portefeuille</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="w-[16px]">
                                        @if ($has_cheques)
                                            <x-icons.check class="block w-4 h-4" />
                                        @else
                                            <x-icons.close class="block w-[10px] h-[10px] ml-[3px]" />
                                        @endif
                                    </span> <span>Opleidingscheques</span>
                                </div>
                                @if ($has_location)
                                    <div class="flex items-center gap-4 mt-4">
                                        <span class="w-[16px]">
                                            <x-icons.location class="block w-4 h-4" />
                                        </span>
                                        <div class="flex flex-wrap">
                                            @foreach ($unique_start_date_locations as $key => $start_date)
                                                <span>{{ $start_date->location->name }}</span>
                                                @if ($key < count($unique_start_date_locations) - 1)
                                                    ,&nbsp;
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-8"> {{ $courses }} </div>

        </div>

</x-app-layout>
