<div class="container py-5">
    <h2>{{ $property->name }}</h2>
    <p><strong>Lokasi:</strong> {{ $property->location }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($property->price, 0, ',', '.') }}</p>
    <p><strong>Luas Tanah:</strong> {{ $property->land_area }} m²</p>
    <p><strong>Deskripsi:</strong> {{ $property->description }}</p>

    @if ($property->image)
        <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="img-fluid mb-4">
    @endif

    <hr>

    <h4>Form Pendaftaran Pembeli</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" wire:model="name" class="form-control">
            @error('name') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" wire:model="phone" class="form-control">
            @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <button type="submit" class="btn btn-success">Daftar</button>
    </form>
</div>
