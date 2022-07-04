<?php

use App\Book;
use Illuminate\Database\Seeder;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('age_groups')->insert([

            [
                'age_group' => '3 5',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'age_group' => '12',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'age_group' => '9 11',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'age_group' => '6 8',
                'created_at' => now(),
                'updated_at' => now()
            ],


            [
                'age_group' => '0 2',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);

        foreach (Book::all() as $book){
            $ageGroup = \App\AgeGroup::inRandomOrder()->take(rand(1,4))->pluck('id');
            $book->ageGroups()->attach($ageGroup);


        }


    }
}
