<nav class="bg-teal-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">Sistem Akademik</div>

        <div class="flex items-center space-x-6">

            <a href="/dashboard" class="hover:underline">Dashboard</a>

            @if(Auth::user()->role === 'mahasiswa')
            <a href="{{ route('krs.index') }}" class="hover:underline">KRS</a>
            <a href="{{ route('khs.saya') }}" class="hover:underline">KHS Saya</a>
            @endif

            @if(Auth::user()->role === 'dosen')
            <a href="{{ route('penilaian.index') }}" class="hover:underline">Penilaian</a>
            @endif

            @if(Auth::user()->role === 'tu')
            <a href="/mahasiswa" class="hover:underline">Data Mahasiswa</a>
            <a href="/dosen" class="hover:underline">Data Dosen</a>
            <a href="/matakuliah" class="hover:underline">Data Matakuliah</a>
            @endif

            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-600 bg-white hover:text-gray-700">
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
                            Profil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>