<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $table = 'cats';

    protected $fillable = [
        'name',
        'des',
        'dess',
        'filer',
        'img',
        'img2',
    ];


    public function subcats() 
    { 
        return $this->hasMany(Subcat::class, 'catid'); 
    }


    public function catprods() 
    { 
        return $this->hasMany(Prod::class, 'catid'); 
    }
}
