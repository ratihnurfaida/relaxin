<nav x-data="{ open: false }" class="bg-primary border-b border-white/10 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-black text-white tracking-tighter">
                        Relax<span class="text-rose-500">in</span>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- TAMPILAN JIKA SUDAH LOGIN --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-white/20 text-sm font-medium rounded-full text-white bg-white/10 hover:bg-white/20 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- TAMPILAN JIKA BELUM LOGIN (GUEST) --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-6 py-2 text-sm font-medium text-white border border-white/30 rounded-full hover:bg-white/10 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 text-sm font-medium text-white bg-rose-500 rounded-full hover:bg-rose-600 shadow-lg shadow-rose-500/30 transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>