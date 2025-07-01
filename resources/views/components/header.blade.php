<nav class="bg-teal-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">Sistem Penilaian MK</div>

        <div class="flex items-center space-x-6">
            <a href="/dashboard" class="hover:underline">Home</a>

            @if(Auth::user() && (Auth::user()->role === 'dosen' || Auth::user()->role === 'tu'))
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="hover:underline inline-flex items-center">
                    Manajemen Data
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.586l3.71-3.356a.75.75 0 111.04 1.08l-4.25 3.857a.75.75 0 01-1.04 0L5.21 8.29a.75.75 0 01.02-1.08z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute mt-2 w-48 bg-white rounded shadow-lg py-2 z-50 border">
                    <a href="/mahasiswa" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Data Mahasiswa</a>
                    <a href="/matakuliah" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Data Matakuliah</a>
                    <a href="/dosen" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Data Dosen</a>
                </div>
            </div>
            @endif

            @if(Auth::user() && Auth::user()->role === 'dosen')
            <a href="/nilai" class="hover:underline">Data Nilai</a>
            @endif

            @if(Auth::user() && Auth::user()->role === 'mahasiswa')
            <a href="{{ route('nilai.saya') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Nilai Saya
            </a>
            @endif

            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-600 bg-white hover:text-gray-700 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>