<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $table = 'neighborhoods';

    protected $fillable = [
        'title',
        'slug',
        'code',
        'banner',
        'zip',
        'city',
        'state',
        'country',
        'map',
        'images',
        'description',
        'status',
    ];

    public function getImagesAttribute($value)
    {
        return $value ? json_decode($value) : null;
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = $value ? json_encode($value) : null;
    }
}
