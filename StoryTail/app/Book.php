<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Book extends Model
{



    protected $fillable = [
        'title', 'summary', 'cover','illustrator','book_url','slug','numberPages','activity','averageRating'
    ];

    public function activityTypes(){

        return $this->belongsToMany(ActivityType::class)->withTimestamps();
    }



    public function authors(){

        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    public function ageGroups(){

        return $this->belongsToMany(AgeGroup::class)->withTimestamps();
    }

    public function themes(){

        return $this->belongsToMany(Theme::class)->withTimestamps();
    }

    public function users(){

        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['is_favourite', 'rating', 'read_date', 'id']);
    }



  /*  protected static function booted()
    {
        static::creating(function ($book) {
            $book->slug = Str::slug($book->title);
        });
    }*/

    public function setTitleAttribute($title){

      $this->attributes['title']=$title;
      $this->attributes['slug']= Str::slug($title, '-');

  }


}
