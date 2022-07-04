<?php

use App\Author;
use App\Book;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('authors')->insert([
            [
                'name' => 'Julia Donaldson',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Anna Llenas',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Roald Dahl',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Kate DiCamillo',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Rita Williams-Garcia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Eric Carle',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Chris Van Allsburg',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Robert Munsch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ann M. Martin',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Jan Brett',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Bryan Collier',
                'created_at' => now(),
                'updated_at' => now()
            ],


        ]);
        foreach (Book::all() as $book){
            $author = Author::inRandomOrder()->take(rand(1,2))->pluck('id');
            $book->authors()->attach($author);


        }
    }
}
