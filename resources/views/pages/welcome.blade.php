{{-- resources/views/pages/welcome.blade.php --}}
<x-app-layout>

@section('title', 'Temukan Hotel Terbaikmu')

@section('content')

    {{-- Hero + Search bar --}}
    @include('components.hero')

    {{-- Rekomendasi Hotel --}}
    @include('components.hotel-recommendations', ['hotels' => $hotels])

@endsection

@push('scripts')
<script>
    // Toggle favorit
    document.querySelectorAll('.fav-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            this.textContent = this.textContent.trim() === '🤍' ? '❤️' : '🤍';
        });
    });
</script>
</x-app-layout> 
