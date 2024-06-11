<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchSave extends Model
{
    use HasFactory;

    protected $table = 'search_saves';

    protected $fillable = [
        'user_id',
        'title',
        'search_query'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
