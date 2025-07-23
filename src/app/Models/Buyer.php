<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'property_id',
        'status',
    ];

    // Relasi ke properti
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
