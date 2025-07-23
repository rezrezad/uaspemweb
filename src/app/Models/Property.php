<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'price',
        'type',
        'bedrooms',
        'bathrooms',
        'land_area',
        'description',
        'image',
        'status',
    ];

    // Relasi ke pembeli (buyers)
    public function buyers()
    {
        return $this->hasMany(Buyer::class);
    }
}
