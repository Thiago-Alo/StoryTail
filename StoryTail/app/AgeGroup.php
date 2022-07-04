<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AgeGroup extends Model
{



    protected $fillable = [
        'age_group'
    ];

    public function getAgeGroupAttribute($key): String
    {


        $checkMaxAge=Str::contains($key,' ');

        if($checkMaxAge){

            $minAge = Str::beforeLast($key, ' ');
            $maxAge = Str::afterLast($key, ' ');

            $key= $minAge."-".$maxAge ;
        }else{

            $key= $key. "+";
        }




        return  $key;


    }


    public function books(){

        return $this->belongsToMany(Book::class)->withTimestamps();
    }

}
