<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'code',
        'title',
        'slug',
        'price',
        'neighborhood_id',
        'listing_status',
        'size',
        'bedrooms',
        'bathrooms',
        'parking_spaces',
        'banner',
        'gallery',
        'map',
        'description',
        'address',
        'country',
        'state',
        'city',
        'dev_lvl',
        'year_built',
        'property_tax',
        'hoa_fees',
        'rent_cycle',
        'date_available',
        'status',
    ];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
