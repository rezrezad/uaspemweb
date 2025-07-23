<div class="container py-5">
    <h2 class="mb-4">Daftar Properti</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($properties as $property)
            <div class="col">
                <div class="card h-100">
                    @if ($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" alt="{{ $property->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->name }}</h5>
                        <p class="card-text">{{ $property->location }}</p>
                        <p class="card-text">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                        <a href="{{ route('property.detail', $property->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
