<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-[79px]">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-[79px]">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center mr-4 shrink-0">
                    <a href="{{ route('home') }}">
                        <x-icons.syntra-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
                </div>

                <div class="flex items-center h-full ml-4">
                    <form action="{{ route('opleidingen.index') }}" method="get">
                        <x-text-input placeholder="Vind je opleiding" 
                            name="search" 
                            class="w-full h-10 px-4 text-sm text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-700 focus:outline-none focus:ring focus:ring-syntra focus:ring-opacity-50" 
                            value="{{ request()->query('search') }}"
                        />
                    </form>
                </div>

                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <div class="hidden sm:flex">
                {{-- <div class="w-40 bg-gray-100 dark:bg-gray-700"></div>
                <div class="w-40 bg-syntra"></div>
                <div class="w-20 bg-syntra"></div>
                <div class="w-40 bg-syntra"></div> --}}
            </div>

        </div>
    </div>

</nav>
