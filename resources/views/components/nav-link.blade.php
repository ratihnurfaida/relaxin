@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{-- resources/views/components/nav-link.blade.php --}}
<nav
    id="navbar"
    class="fixed top-0 inset-x-0 z-50 h-16 bg-primary flex items-center justify-between px-6 md:px-10
           shadow-[0_4px_24px_rgba(6,182,212,0.3)] transition-shadow duration-300"
>
    {{-- Logo --}}
    <a href="{{ url('/') }}" class="font-display text-2xl font-black text-white tracking-tight">
        Relax<span class="text-[#A5F3FC]">in</span>
    </a>

    {{-- Desktop nav links --}}
    <ul class="hidden md:flex gap-8 text-sm font-medium text-white/85">
        <li><a href="#hotels"       class="hover:text-white transition-colors">Hotel</a></li>
        <li><a href="#destinations" class="hover:text-white transition-colors">Destinasi</a></li>
        <li><a href="#promo"        class="hover:text-white transition-colors">Promo</a></li>
        <li><a href="#features"     class="hover:text-white transition-colors">Tentang</a></li>
    </ul>

    {{-- Auth buttons --}}
    <div class="flex items-center gap-3">
        @auth
            <span class="hidden md:block text-white/80 text-sm">Hi, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost text-sm">Keluar</button>
            </form>
        @else
            <a href="{{ route('login') }}"    class="btn-ghost">Masuk</a>
            <a href="{{ route('register') }}" class="btn-rose text-sm">Daftar</a>
        @endauth
    </div>
</nav>
