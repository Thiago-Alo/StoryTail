<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{


    protected $fillable = [
        'name',
    ];

    public function books(){

        return $this->belongsToMany(Book::class)->withTimestamps();
    }



}
