<x-app-layout>
    <div class="text-gray-900 dark:text-gray-100">

        @if ($course->courseType)
            <div> {{ $course->courseType->name }} </div>
        @endif

        @if ($course->title)
            <h1> {{ $course->title }} </h1>
        @endif

        @if ($course->teaser)
            <p> {{ $course->teaser }} </p>
        @endif

        @if ($course->image)
            <img src="{{ $course->image }}" alt="{{ $course->title }}">
        @endif

        @if ($course->price_incl)
            <p> € {{ $course->price_incl }} <span> incl. </span> </p>

            @if ($course->price_excl)
                <p>€ {{ $course->price_excl }} excl. btw </p>
            @endif
        @endif

        <div class="flex flex-wrap gap-8 ">
            @if ($course->sector)
                <div class="flex flex-col">
                    <div>Sector</div>
                    <div> {{ $course->sector->name }} </div>
                </div>
            @endif

            @if ($course->duration)
                <div class="flex flex-col">
                    <div>Tijdsuur</div>
                    <div> {{ $course->duration->name }} </div>
                </div>
            @endif
        </div>

        @if ($course->startDates)
            <div>
                <h2>Startdatum(s)</h2>
                @foreach ($course->startDates as $startDate)
                    <?php
                    $spots = $startDate->available_spaces;
                    ?>
                    <div>
                        <div> {{ $startDate->day->name }}</div>
                        <div> {{ $startDate->location->name }} </div>
                        <div> {{ $startDate->formatted_date }} </div>
                        <div> {{ $spots }} {{ $spots === 1 ? 'plaats' : 'plaatsen' }} beschikbaar</div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($course->details_text)
            <h2>In Detail</h2>
            <div>
                {!! $course->details_text !!}

                @if ($course->details_extra_info || $course->details_for_text)
                    <div class="flex">

                        @if ($course->details_extra_info)
                            <div>
                                <h3>Extra info</h3>
                                <div>
                                    {!! $course->details_extra_info !!}
                                </div>
                            </div>
                        @endif

                        @if ($course->details_for_text)
                            <div>
                                <h3>Voor wie?</h3>
                                <div>
                                    {!! $course->details_for_text !!}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        @if ($course->program_text)
            <div>
                <div>
                    <h2>Programma</h2>
                    <div>
                        Ontdek het volledige programma in detail
                    </div>
                    @if ($course->kmo_theme_id)
                        <span class="bg-[#71bdba] text-white">Kmo Portefuille</span>
                    @endif
                    @if ($course->specialProperties)
                        @foreach ($course->specialProperties as $specialProperty)
                            <span class="bg-[#71bdba] text-white">{{ $specialProperty->name }}</span>
                        @endforeach
                    @endif
                </div>
                <div>
                    {!! $course->program_text !!}
                </div>
            </div>
        @endif

        @if ($course->priceDetails)
            <h3>Samenstelling prijs</h3>
            <div>
                <div>Inschrijvingsprijs</div>
                <div> € {{ $course->price_excl }} excl. btw </div>
                <div> € {{ $course->price_incl }} incl. btw </div>

            </div>
            @foreach ($course->priceDetails as $priceDetail)
                {{ $priceDetail }}
                <div>
                    <div> {{ $priceDetail->name }} </div>
                    <div> € {{ $priceDetail->price_excl }} excl. btw </div>
                    <div> € {{ $priceDetail->price_incl }} incl. btw</div>
                </div>
            @endforeach

            <div>
                <div>Totaalprijs inclusief kosten</div>
                <?php
                $totalPriceIncl = $course->price_incl;
                $totalPriceIncl += $course->priceDetails->sum('price_incl');
                
                $totalPriceExcl = $course->price_excl;
                $totalPriceExcl += $course->priceDetails->sum('price_excl');
                ?>
                <div>
                    € {{ $totalPriceExcl }} excl. btw
                </div>
                <div>
                    € {{ $totalPriceIncl }} incl. btw
                </div>
            </div>
        @endif

        @if ($course->savings)
            <?php
            $has_flemish = $course->savings->where('name', 'flemish')->first();
            $has_cheques = $course->savings->where('name', 'cheques')->first();
            $has_kmo = $course->savings->where('name', 'kmo')->first();
            ?>
            <h3>Besparingen</h3>
            @if ($has_flemish)
                <div class="flex">
                    <x-icons.check class="w-6 !text-gray-400" />
                    <p>
                        Bespaar dankzij <strong>opleidingscheques</strong> elk jaar vanaf september tot 250 euro (*) bij
                        SyntraPXL. <a href="/klantencentrum/opleidingscheques-kmo-portefeuille-tussenkomsten"
                            target="_blank">Meer informatie over opleidingscheques</a>.
                    </p>
                </div>
            @endif
            @if ($has_cheques)
                <div class="flex">
                    <x-icons.check class="w-6 !text-gray-400" />
                    <p>
                        Deze opleiding komt in aanmerking voor&nbsp;<strong>Vlaams opleidingsverlof.</strong>&nbsp;<a
                            href="https://www.vlaanderen.be/vlaams-opleidingsverlof" rel="noopener noreferrer"
                            target="_blank">Meer info &amp; voorwaarden</a>.
                    </p>
                </div>
            @endif

            @if ($has_kmo)
                <div class="flex justify-between w-full bg-[#009B48] h-[410px] p-12"
                    style="
  background-image: url(https://www.syntrapxl.be/themes/custom/syntra_pxl/img/svg/bg-lion.svg);
  background-position: 100%;
  background-repeat: no-repeat;
  background-size: auto 100%;
  color: #fff;
                ">
                    <div class="w-[350px]">
                        <h2>Kmo-portefeuille</h2>
                        <div><span>THEMA:</span> {{ $course->kmoTheme->name }}</div>
                        <p>De kmo-portefeuille is een subsidie van de Vlaamse Overheid waardoor je tot 30%
                            van&nbsp;je&nbsp;inschrijvingsgeld kan recupereren. <a
                                href="/klantencentrum/opleidingscheques-kmo-portefeuille-tussenkomsten/kmo-portefeuille-algemene"
                                target="_blank">Lees hier hoe de KMO-portefeuille</a> in zijn werk gaat.</p>
                    </div>

                    <div class="flex flex-col w-[300px] flex-end justify-end h-full">
                        <div class="right">
                            <ul class="prices">
                                <li>
                                    <em>MO*</em>
                                    <span>€ 1479.06</span>

                                </li>
                                <li>
                                    <em>KO**</em>
                                    <span>€ 1294.17</span>

                                </li>
                            </ul>
                            <p>Netto verschuldigd bedrag voor:</p>
                            <p>* middelgrote ondernemingen<br><br>
                                ** kleine ondernemingen</p>

                        <x-icons.lion /> 

                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
