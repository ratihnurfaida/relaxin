<nav class="fixed inset-x-0 top-0 z-50 h-16 bg-primary
            flex items-center justify-between px-6 md:px-10
            shadow-[0_4px_20px_rgba(6,182,212,.3)]">

    {{-- Logo --}}
    <a href="{{ url('/') }}"
       class="font-display text-[1.55rem] font-black text-white tracking-tight">
        Relax<span class="text-[#A5F3FC]">in</span>
    </a>

    {{-- Auth buttons --}}
    <div class="flex items-center gap-2.5">
        @auth
            <span class="hidden md:block text-white/75 text-sm">
                Halo, {{ Auth::user()->name }}
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="border border-white/40 text-white/90 text-sm font-medium
                               px-4 py-1.5 rounded-full hover:bg-white/15 transition">
                    Keluar
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
               class="border border-white/40 text-white/90 text-sm font-medium
                      px-4 py-1.5 rounded-full hover:bg-white/15 transition">
                Masuk
            </a>
            <a href="{{ route('register') }}"
               class="bg-rose text-white text-sm font-bold
                      px-4 py-1.5 rounded-full hover:bg-rose/90 transition">
                Daftar
            </a>
        @endauth
    </div>
</nav>