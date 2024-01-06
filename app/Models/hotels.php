<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'cellphone', 'website', 'image', 'zone', 'zone_name'
    ];

    protected $casts = [
        'stars' => 'integer',
        'price' => 'float',
    ];
}
