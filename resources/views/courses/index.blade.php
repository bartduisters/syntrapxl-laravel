<x-app-layout>

    <style>
        input {
            margin-right: 0.5rem;
            margin-top: -0.2rem;
        }

        label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="flex">
        <div class="w-full min-h-screen p-5 text-gray-900 bg-white max-w-80 dark:bg-gray-800 dark:text-gray-100">
            <form id="filterForm" action="" class="flex flex-col gap-4">
                <div>
                    <h2 class="text-xl font-bold">Startdatum</h2>
                    <?php
                    $selectedStartDates = request()->input('start_dates', []);
                    ?>

                    @foreach ($start_dates as $startDate)
                        <label for="startDate-{{ $startDate['timestamp'] }}">
                            <span>
                                <input type="checkbox" name="start_dates[]" id="startDate-{{ $startDate['timestamp'] }}"
                                    value="{{ $startDate['timestamp'] }}"
                                    {{ in_array($startDate['timestamp'], $selectedStartDates) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $startDate['name'] }}
                            </span>
                            <span>
                                {{ $startDate['count'] }}
                            </span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Type</h2>
                    <?php
                    $selectedCourseTypes = request()->input('course_types', []);
                    ?>

                    @foreach ($course_types as $courseType)
                        <label for="courseType-{{ $courseType->id }}">
                            <span>
                                <input type="checkbox" name="course_types[]" id="courseType-{{ $courseType->id }}"
                                    value="{{ $courseType->id }}"
                                    {{ in_array($courseType->id, $selectedCourseTypes) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $courseType->name }}</span>
                            <span>{{ $courseType->courses_count }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- <div>
                    <h2 class="text-xl font-bold">Duur</h2>
                    <?php
                    $selectedDurations = request()->input('durations', []);
                    ?>
                    @foreach ($durations as $duration)
                        <div>
                            <label for="duration-{{ $duration->id }}">
                                <span>
                                    <input type="checkbox" name="durations[]" id="duration-{{ $duration->id }}"
                                        value="{{ $duration->id }}"
                                        {{ in_array($duration->id, $selectedDurations) ? 'checked' : '' }}
                                        onchange="document.getElementById('filterForm').submit()">
                                    {{ $duration->name }}</span>
                                <span>{{ $duration->courses_count }}</span>
                            </label>
                        </div>
                    @endforeach
                </div> --}}

                <div>
                    <h2 class="text-xl font-bold">Locaties</h2>
                    <?php
                    $selectedLocations = request()->input('locations', []);
                    ?>

                    @foreach ($locations as $location)
                        <label for="location-{{ $location->id }}">
                            <span>
                                <input type="checkbox" name="locations[]" id="location-{{ $location->id }}"
                                    value="{{ $location->id }}"
                                    {{ in_array($location->id, $selectedLocations) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $location->name }}</span>
                            <span>{{ $location->start_dates_count }}</span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Besparen</h2>
                    <?php
                    $selectedSavings = request()->input('savings', []);
                    ?>

                    @foreach ($savings as $saving)
                        <label for="saving-{{ $saving->id }}">
                            <span>
                                <input type="checkbox" name="savings[]" id="saving-{{ $saving->id }}"
                                    value="{{ $saving->id }}"
                                    {{ in_array($saving->id, $selectedSavings) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $saving->name }}</span>
                            <span>{{ $saving->courses_count }}</span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Bijzonder kenmerk</h2>
                    <?php
                    $selectedSpecialProperties = request()->input('special_properties', []);
                    ?>

                    @foreach ($special_properties as $specialProperty)
                        <label for="specialProperty-{{ $specialProperty->id }}">
                            <span>
                                <input type="checkbox" name="special_properties[]"
                                    id="specialProperty-{{ $specialProperty->id }}" value="{{ $specialProperty->id }}"
                                    {{ in_array($specialProperty->id, $selectedSpecialProperties) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $specialProperty->name }}</span>
                            <span>{{ $specialProperty->courses_count }}</span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Niveau</h2>
                    <?php
                    $selectedLevels = request()->input('levels', []);
                    ?>

                    @foreach ($levels as $level)
                        <label for="level-{{ $level->id }}">
                            <span>
                                <input type="checkbox" name="levels[]" id="level-{{ $level->id }}"
                                    value="{{ $level->id }}"
                                    {{ in_array($level->id, $selectedLevels) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $level->name }}</span>
                            <span>{{ $level->courses_count }}</span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Studievorm</h2>
                    <?php
                    $selectedStudyTypes = request()->input('study_types', []);
                    ?>

                    @foreach ($study_types as $studyType)
                        <label for="studyType-{{ $studyType->id }}">
                            <span>
                                <input type="checkbox" name="study_types[]" id="studyType-{{ $studyType->id }}"
                                    value="{{ $studyType->id }}"
                                    {{ in_array($studyType->id, $selectedStudyTypes) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $studyType->name }}</span>
                            <span>{{ $studyType->courses_count }}</span>
                        </label>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-xl font-bold">Sector</h2>
                    <?php
                    $selectedSectors = request()->input('sectors', []);
                    $sectors = $sectors->sortBy('name');
                    ?>

                    @foreach ($sectors as $sector)
                        <label for="sector-{{ $sector->id }}">
                            <span>
                                <input type="checkbox" name="sectors[]" id="sector-{{ $sector->id }}"
                                    value="{{ $sector->id }}"
                                    {{ in_array($sector->id, $selectedSectors) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                {{ $sector->name }}</span>
                            <span>{{ $sector->courses_count }}</span>
                        </label>
                    @endforeach
                </div>
            </form>
        </div>

        <div class="text-gray-900 dark:text-gray-100 md:px-[8.3%]">

            <div class="my-11">
                <span class="text-xl font-bold"> {{ $courses->total() }} </span>
                {{ $courses->total() == 1 ? 'opleiding gevonden' : 'opleidingen gevonden' }}
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($courses as $course)
                    <form action="{{ route('opleidingen.show', $course) }}" method="get">
                        <button type="submit" class="w-full text-left max-w-[1200px]">
                            <x-course.card :course="$course" />
                        </button>
                    </form>
                @endforeach
            </div>

            <div class="my-8"> {{ $courses }} </div>

        </div>

</x-app-layout>
