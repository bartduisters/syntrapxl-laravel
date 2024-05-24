<style>
    .details::after {
        background-position: 0;
        background-repeat: no-repeat;
        background-size: cover;
        bottom: 0;
        content: '';
        display: block;
        /* --spacer-default: 0.5rem;
        left: calc(var(--spacer-default) * -2); */
        opacity: 1;
        pointer-events: none;
        position: absolute;
        top: -0.1rem;
        transition: opacity 0.5s ease;
        width: 100%;
        will-change: opacity;
        background-image: url({{ asset('images/syntra-rings.svg') }});
    }


    @media (prefers-color-scheme: dark) {
        .details::after {
            background-image: url('../images/syntra-rings-dark.svg');
        }
    }

    .left__content::after {
        background-image: url(https://www.syntrapxl.be/themes/custom/syntra_pxl/img/svg/union-transparent.svg);
        background-position: 0 0;
        background-repeat: no-repeat;
        background-size: 100%;
        content: "";
        display: block;
        pointer-events: none;
        position: absolute;
        transform: translateX(-46%);
        width: 32rem;
        height: 100%;
    }

    .business-developer::before {
        background-image: url(https://www.syntrapxl.be/themes/custom/syntra_pxl/img/svg/union-white.svg);
        background-position: 0 0;
        background-repeat: no-repeat;
        background-size: 100%;
        content: "";
        display: block;
        pointer-events: none;
        position: absolute;
        width: 32rem;
        height: 33rem;
        transform: translate(-15%, -30%);
    }
</style>

<x-app-layout>
    <div class="text-gray-900 dark:text-gray-100">

        <div class="flex justify-end bg-white dark:bg-gray-800">
            <div class="flex-grow relative w-2/4 pl-[14rem] pt-8 pb-[100px]">
                <div class="flex flex-col gap-4 ml-[-200px]">
                    <p class="text-xs font-bold text-gray-500 uppercase dark:text-gray-400">
                        {{ $course->courseType->name }}</p>
                    <h1 class="text-4xl font-bold uppercase">{{ $course->title }}</h1>
                    <p class="text-lg">{{ $course->teaser }}</p>
                    <div>
                        <h1 class="text-3xl font-extrabold text-syntra">€ {{ $course->price_incl }} incl.</h1>
                        <p>€ {{ $course->price_excl }} excl. BTW</p>
                    </div>
                    <div class="flex gap-4">
                        <div
                            class="flex items-center justify-center gap-2 p-2 px-5 text-xl text-white border border-solid rounded-full cursor-pointer bg-syntra shrink-0 whitespace-nowrap w-fit h-fit hover:bg-red-600 hover:text-white">
                            Inschrijven</div>

                        <div
                            class="flex items-center justify-center gap-2 p-2 px-5 text-xl text-gray-800 border border-gray-800 border-solid rounded-full cursor-pointer dark:text-gray-100 dark:border-gray-100 shrink-0 whitespace-nowrap w-fit h-fit hover:bg-gray-800 hover:text-white">
                            {{-- <x-icons.mail class="w-6 h-6 text-gray-800" /> --}}
                            <div> Ik heb een vraag</div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="relative flex w-2/4 overflow-hidden details">
                <img class="object-cover object-center w-full h-auto pl-20 mg" src="{{ $course->image }}" />
            </div>
        </div>

        <div
            class="left-[300px] w-2/3 flex items-center h-[100px] shadow-md bg-white dark:bg-gray-800 rounded-lg mt-[-60px] absolute p-4 border border-gray-50 dark:border-gray-900 dark:text-gray-100">
            <div class="flex gap-32 mx-4">
                @if ($course->sector)
                    <div>
                        <div class="text-xs">Sector</div>
                        <div class="text-xl text-syntra">{{ $course->sector->name ?? '/' }}</div>
                    </div>
                @endif
                @if ($course->duration)
                    <div>
                        <div class="text-xs">Tijdsduur</div>
                        <div class="text-xl text-syntra">{{ $course->duration->name ?? '/' }}</div>
                    </div>
                @endif
                @if ($course->study_type)
                    <div>
                        <div>Leervorm</div>
                        <div class="text-xl text-syntra">{{ $course->study_type->name ?? '/' }}</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-900 py-28">
            <div class="pt-8 z-20 ml-[300px]">
                <div class="mb-5 text-3xl font-extrabold">STARTDATUM(S)</div>

                <div class="flex flex-wrap mb-[3.2rem] ml-[-8px]">

                    @if ($course->startDates)
                        @foreach ($course->startDates as $startDate)
                            <?php
                            $spots = $startDate->available_spaces;
                            ?>
                            <div class="p-2 w-[309px]">
                                <div
                                    class="w-full min-h-full px-6 py-4 bg-white dark:bg-gray-800 border-gray-700 shadow-lg hover:border max-h-max h-[100px]">
                                    <div class="flex gap-2">
                                        <div class="text-sm font-bold uppercase">{{ $startDate->day->name }}</div>
                                        <div class="text-sm font-bold uppercase">{{ $startDate->location->name }}</div>
                                    </div>
                                    <div class="text-lg font-bold">{{ $startDate->formatted_date }}</div>
                                    <div class="text-xs text-syntra">
                                        {{ $spots }} {{ $spots === 1 ? 'plaats' : 'plaatsen' }} beschikbaar
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="p-2 w-[309px] mr-8">
                        <div class="py-4 px-3 flex justify-between items-center h-[100px] bg-syntra">
                            <div class="text-sm text-white">Hou me op de hoogte van nieuwe startdata</div>
                            <x-icons.arrow-right class="text-sm text-white w-9 h-9" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 py-28">
            <div class="ml-[300px] mr-8">
                @if ($course->details_text)
                    <h2 class="mb-8 text-4xl font-bold uppercase">In Detail</h2>
                    <style>
                        p {
                            margin-bottom: 1.6rem;
                            margin-top: 1.6rem;
                        }
                    </style>
                    <div>
                        {!! $course->details_text !!}
                        <div class="mt-16" x-data="{ tabToShow: '{{ $course->details_extra_info ? 'extra' : ($course->details_for_text ? 'who' : '') }}' }">
                            @if ($course->details_extra_info || $course->details_for_text)
                                <div class="flex gap-4">
                                    @if ($course->details_extra_info)
                                        <h3 class="flex justify-center flex-1 pb-4 text-2xl uppercase border-b-4 cursor-pointer dark:border-gray-500"
                                            :class="{ '!border-syntra': tabToShow === 'extra' }"
                                            x-on:click="tabToShow = 'extra'">Extra info</h3>
                                    @endif

                                    @if ($course->details_for_text)
                                        <h3 class="flex justify-center flex-1 pb-4 text-2xl uppercase border-b-4 cursor-pointer dark:border-gray-500"
                                            :class="{ '!border-syntra': tabToShow === 'who' }"
                                            x-on:click="tabToShow = 'who'">Voor wie?</h3>
                                    @endif
                                </div>

                                <div>
                                    <div x-show="tabToShow === 'extra'">
                                        {!! $course->details_extra_info !!}
                                    </div>
                                    <div x-show="tabToShow === 'who'">
                                        {!! $course->details_for_text !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-900 pb-28">
            <div class="z-20 ml-[300px] mr-8">

                @if ($course->program_text)
                    <div class="flex gap-8 left__content">
                        <div class="relative">
                            <div class="sticky top-0 z-10 flex-1 pt-20">
                                <h2 class="mb-8 text-4xl font-bold uppercase">Programma</h2>
                                <div class="mb-6">
                                    Ontdek het volledige programma in detail
                                </div>
                                @if ($course->kmo_theme_id)
                                    <span
                                        class="bg-[#71bdba] text-white rounded-sm py-[0.2rem] px-[0.8rem] text-xs font-bold">Kmo
                                        Portefuille</span>
                                @endif
                                @if ($course->specialProperties)
                                    @foreach ($course->specialProperties as $specialProperty)
                                        <span
                                            class="bg-[#71bdba] text-white rounded-sm py-[0.2rem] px-[0.8rem] text-xs font-bold">{{ $specialProperty->name }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            {!! $course->program_text !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 py-28">
            <div class="ml-[300px] mr-8 flex gap-16">

                <div class="flex-1">
                    @if ($course->priceDetails)
                        <h3 class="mb-8 text-2xl font-bold uppercase">Samenstelling prijs</h3>
                        <div class="flex justify-between gap-8 py-4 border-b dark:border-gray-500">
                            <div class="text-xl font-bold uppercase">Inschrijvingsprijs</div>
                            <div class="flex items-end gap-4">
                                <div> € {{ $course->price_excl }} excl. btw </div>
                                <div class="text-xl font-bold"> € {{ $course->price_incl }} incl.</div>
                            </div>
                        </div>
                        @foreach ($course->priceDetails as $priceDetail)
                            <div class="flex justify-between gap-8 py-4 border-b dark:border-gray-500">
                                <div>{{ $priceDetail->name }}</div>
                                <div class="flex items-end gap-4">
                                    <div> € {{ $priceDetail->price_excl }} excl. btw </div>
                                    <div class="text-xl font-bold"> € {{ $priceDetail->price_incl }} incl.</div>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-between gap-8 py-4">
                            <div class="text-2xl font-bold uppercase text-syntra">Totaalprijs incl. kosten</div>
                            <?php
                            $totalPriceIncl = $course->price_incl;
                            $totalPriceIncl += $course->priceDetails->sum('price_incl');
                            
                            $totalPriceExcl = $course->price_excl;
                            $totalPriceExcl += $course->priceDetails->sum('price_excl');
                            ?>
                            <div class="flex items-end gap-4">
                                <div> € {{ $totalPriceExcl }} excl. btw </div>
                                <div class="text-xl font-bold text-syntra"> € {{ $totalPriceIncl }} incl. </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex-1">

                    @if ($course->savings)
                        <?php
                        $has_flemish = $course->savings->where('name', 'flemish')->first();
                        $has_cheques = $course->savings->where('name', 'cheques')->first();
                        ?>
                        <h3 class="mb-8 text-2xl font-bold uppercase">Besparingen</h3>
                        <div class="flex flex-col gap-8">
                            @if ($has_flemish)
                                <div class="flex gap-4">
                                    <div>
                                        <x-icons.check class="w-6 !text-gray-400" />
                                    </div>
                                    <div>
                                        Bespaar dankzij <strong>opleidingscheques</strong> elk jaar vanaf september tot
                                        250 euro
                                        (*) bij
                                        SyntraPXL. <a
                                            href="/klantencentrum/opleidingscheques-kmo-portefeuille-tussenkomsten"
                                            target="_blank">Meer informatie over opleidingscheques</a>.
                                    </div>
                                </div>
                            @endif
                            @if ($has_cheques)
                                <div class="flex gap-4">
                                    <div>
                                        <x-icons.check class="w-6 !text-gray-400" />
                                    </div>
                                    <div>
                                        Deze opleiding komt in aanmerking voor&nbsp;<strong>Vlaams
                                            opleidingsverlof.</strong>&nbsp;<a
                                            href="https://www.vlaanderen.be/vlaams-opleidingsverlof"
                                            rel="noopener noreferrer" target="_blank">Meer info &amp; voorwaarden</a>.
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </div>


        @if ($course->savings)
            <?php
            $has_kmo = $course->savings->where('name', 'kmo')->first();
            ?>

            @if ($has_kmo)
                <div class="w-full bg-[#009B48]"
                    style="
  background-image: url(https://www.syntrapxl.be/themes/custom/syntra_pxl/img/svg/bg-lion.svg);
  background-position: 100%;
  background-repeat: no-repeat;
  background-size: auto 100%;
  color: #fff;
                ">
                    <div class="ml-[300px] mr-8 flex gap-32">
                        <div class="w-[350px]">
                            <h2 class="mt-16 text-4xl font-bold uppercase">Kmo-portefeuille</h2>
                            <div class="font-bold"><span class="font-bold underline">THEMA:</span>
                                {{ $course->kmoTheme->name }}</div>
                            <p>De kmo-portefeuille is een subsidie van de Vlaamse Overheid waardoor je tot 30%
                                van&nbsp;je&nbsp;inschrijvingsgeld kan recupereren. <a
                                    href="/klantencentrum/opleidingscheques-kmo-portefeuille-tussenkomsten/kmo-portefeuille-algemene"
                                    target="_blank">Lees hier hoe de KMO-portefeuille</a> in zijn werk gaat.</p>
                        </div>

                        <div class="flex flex-col justify-end h-full mt-40 mb-12 flex-end">
                            <div class="right">
                                <div class="flex gap-32">
                                    <div>
                                        <div class="text-sm">MO*</div>
                                        <div class="text-xl font-bold">€ 1479.06</div>

                                    </div>
                                    <div>
                                        <div class="text-sm">KO**</div>
                                        <div class="text-xl font-bold">€ 1294.17</div>
                                    </div>
                                </div>
                                <p>Netto verschuldigd bedrag voor:</p>
                                <p>* middelgrote ondernemingen<br><br>
                                    ** kleine ondernemingen</p>

                                <x-icons.lion />

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif


        <div class="w-full text-white bg-syntra">
            <div class="ml-[300px] py-28 flex gap-16">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold uppercase">Heb je nog een vraag?</h2>
                    <p>Nog iets niet duidelijk? Stel je vraag dan hieronder aan onze medewerkers en we helpen je graag
                        verder.</p>

                    <label>Bericht</label>
                    <textarea class="w-full mt-1 mb-4 rounded-md" rows="5" placeholder="Vul hier je vraag in"></textarea>

                    <label>Naam</label>
                    <input class="w-full mt-1 mb-4 rounded-md" />

                    <label>E-mail</label>
                    <input class="w-full mt-1 mb-4 rounded-md" placeholder="Waar kunnen we je contacteren?" />

                    <div
                        class="flex items-center justify-center gap-2 p-2 px-5 mt-4 text-gray-100 bg-gray-800 border border-gray-800 border-solid rounded-full cursor-pointer shrink-0 whitespace-nowrap w-fit h-fit">
                        <div>Verzenden</div>
                    </div>
                </div>
                <div class="flex items-center justify-center flex-1">
                    <?php
                    $business_developer = $course->people->where('is_business_developer', true)->first();
                    ?>
                    @if ($business_developer)
                        <div class="flex flex-col items-center max-w-[360px] business-developer">
                            <img class="w-[152px] h-auto rounded-full" src="{{ $business_developer->image }}" />
                            <p class="font-bold text-center uppercase">
                                Deze opleiding werd zorgvuldig samengesteld door {{ $business_developer->name }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- <div class="bg-[#343943]"></div> --}}
    </div>
</x-app-layout>
