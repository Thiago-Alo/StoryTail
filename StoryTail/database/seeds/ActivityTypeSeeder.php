<?php

use App\Book;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('activity_types')->insert([
            [
                'type' => 'English',
                'activity_image'=>'storage/files/activity-type/1/1656944240-language-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Drawing and Painting',
                'activity_image'=>'storage/files/activity-type/2/1656943937-paintbrush-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Art',
                'activity_image'=>'storage/files/activity-type/3/1656951035-artstation-brands.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],


            [
                'type' => 'Geography',
                'activity_image'=>'storage/files/activity-type/4/1656944318-earth-americas-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'History',
                'activity_image'=>'storage/files/activity-type/5/1656944393-landmark-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Crafts',
                'activity_image'=>'storage/files/activity-type/6/1656944036-pen-ruler-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],


            [
                'type' => 'Music',
                'activity_image'=>'storage/files/activity-type/7/1656944483-music-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Maths',
                'activity_image'=>'storage/files/activity-type/8/1656943651-calculator-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Science',
                'activity_image'=>'storage/files/activity-type/9/1656944516-flask-solid.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Computing',
                'created_at' => now(),
                'updated_at' => now(),
                'activity_image'=>'storage/files/activity-type/10/1656943899-computer-solid.svg',
            ],

            [
                'type' => 'Cooking',
                'created_at' => now(),
                'updated_at' => now(),
                'activity_image'=>'storage/files/activity-type/11/1656949893-utensils-solid.svg',
            ],

            [
                'type' => 'Playdough',
                'created_at' => now(),
                'updated_at' => now(),
                'activity_image'=>'storage/files/activity-type/12/1656950459-bucket-solid.svg',
            ],


        ]);

        foreach (Book::all() as $book){
            $activityType = \App\ActivityType::inRandomOrder()->take(rand(1,2))->pluck('id');
            $book->activityTypes()->attach($activityType);


        }
    }
}
