<?php

use App\Book;
use App\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('themes')->insert([
            [
                'name' => 'Animals',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Family',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Feelings',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Food',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Colours',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Numbers',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Shapes',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Body',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Transports',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Weather',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'World',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Planets',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Nature',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Clothes',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Sports and Activites',
                'created_at' => now(),
                'updated_at' => now()
            ],



        ]);

        foreach (Book::all() as $book){
            $theme = Theme::inRandomOrder()->take(rand(1,4))->pluck('id');
            $book->themes()->attach($theme);


        }
    }
}
