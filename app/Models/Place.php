<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image_url', 'latitude', 'longitude','route_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
