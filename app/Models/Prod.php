<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    protected $table = 'prods';

    protected $fillable = [
        'catid',
        'subcatid',
        'name',
        'des',
        'dess',
        'img',
        'img2',
        'filer',
    ];

    // Relation: Prod belongs to Cat
    public function prodcat()
    {
        return $this->belongsTo(Cat::class, 'catid');
    }

    // Relation: Prod belongs to Subcat
    public function prodsubcat()
    {
        return $this->belongsTo(Subcat::class, 'subcatid');
    }
}
