<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityType extends Model
{


    protected $fillable = [
        'type', 'activity_image',

    ];


    public function books(){

        return $this->belongsToMany(Book::class)->withTimestamps();
    }

}
