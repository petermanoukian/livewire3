<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    protected $table = 'subcats';

    protected $fillable = [
        'catid',
        'name',
        'des',
        'dess',
        'img',
        'img2',
        'filer',
    ];

    // Relation: Subcat belongs to Cat
    public function cat()
    {
        return $this->belongsTo(Cat::class, 'catid');
    }
}

