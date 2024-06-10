<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeEval extends Model
{
    use HasFactory;

    protected $table = 'home_evals';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'year_built',
        'size',
        'bedroom',
        'bathroom',
        'half_bathroom',
        'has_suite',
        'garage',
        'garage_type',
        'basement_type',
        'dev_lvl',
        'move_plan',
        'notes',
        'status',
    ];
}
