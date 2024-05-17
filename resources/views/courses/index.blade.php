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
                    <x-course.card :course="$course" />
                @endforeach
            </div>

            <div class="my-8"> {{ $courses }} </div>

        </div>

</x-app-layout>
