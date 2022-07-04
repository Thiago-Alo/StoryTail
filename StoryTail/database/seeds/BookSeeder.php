<?php

use App\Activity;
use App\Book;
use App\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('books')->insert([
            [
                'title' => 'A Squash and a Squeeze', /*- but when she asks a wise old man for help, he suggests a rather strange solution to her problems.*/
                'summary' => 'A story of an anxious little old lady, whose house is just too small but when she asks a wise old man for help, he suggests a rather strange solution to her problems.',
                'cover' => 'storage/files/books/1/cover/cover1656672283-Asquashandasqueeze.pdf',
                'slug' => 'a-squash-and-a-squeeze',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/1/1656672283-Asquashandasqueeze.pdf',
                'numberPages'=> '36',
                'activity'=>'Think about the sounds that each animal makes... croak, squawk, hiss. Can you think of any others?',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Monkey Puzzle',   /*However, Butterfly cannot seem to understand that Monkey and his mum look alike, so attempts to reunite Monkey with an elephant, a parrot and even a bat!*/
                'summary' => 'Monkey is lost in the jungle, so he asks Butterfly to help him find his mum.However, Butterfly cannot seem to understand that Monkey and his mum look alike, so attempts to reunite Monkey with an elephant, a parrot and even a bat!',
                'cover' => 'storage/files/books/2/cover/cover1656672296-MonkeyPuzzle_JuliaDonaldson.pdf',
                'slug' => 'monkey-puzzle',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/2/1656672296-MonkeyPuzzle_JuliaDonaldson.pdf',
                'numberPages'=> '36',
                'activity'=>'Look on the websites of local zoos. Do they look after any of the animals found in the story?',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Colour Monster',/*He is red, green, yellow, blue and black, all at the same time. It`s making him very confused and he doesn`t know why*/
                'summary' => 'The little colour monster is having a hard time, as his feelings are all jumbled up.He is red, green, yellow, blue and black, all at the same time. It`s making him very confused and he doesn`t know why.',
                'cover' => 'storage/files/books/3/cover/cover1656672312-TheColourMonsterBook.pdf',
                'slug' => 'the-colour-monster',
                'illustrator' => '',
                'book_url' => 'storage/files/books/3/1656672312-TheColourMonsterBook.pdf',
                'numberPages'=> '43',
                'activity' => 'Can you mix colours? What new colours can you make?',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Gruffalo',
                'summary' => 'A little mouse walks through the woods and encounters a fox, an owl and a snake. To fend them off, he tells each about the scary Gruffalo - but when the mouse actually encounters the Gruffalo himself, he cleverly invents another tale and manages to escape from danger yet again.',
                'cover' => 'storage/files/books/4/cover/cover1656672461-The_GRUFFALO(2).pdf',
                'slug' => 'the-gruffalo',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/4/1656672461-The_GRUFFALO(2).pdf',
                'numberPages'=> '32',
                'activity'=> 'Write a report about an imaginary creature. What does it eat? Where does it live? How is it adapted to live in that place?',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'title' => 'A Squash and a Squeeze2', /*- but when she asks a wise old man for help, he suggests a rather strange solution to her problems.*/
                'summary' => 'A story of an anxious little old lady, whose house is just too small but when she asks a wise old man for help, he suggests a rather strange solution to her problems.',
                'cover' => 'storage/files/books/6/cover/cover1656672497-Asquashandasqueeze.pdf',
                'slug' => 'a-squash-and-a-squeeze2',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/6/1656672497-Asquashandasqueeze.pdf',
                'numberPages'=> '36',
                'activity'=> 'Write a report about an imaginary creature. What does it eat? Where does it live? How is it adapted to live in that place?',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'title' => 'The Gruffalo2',
                'summary' => 'A little mouse walks through the woods and encounters a fox, an owl and a snake. To fend them off, he tells each about the scary Gruffalo - but when the mouse actually encounters the Gruffalo himself, he cleverly invents another tale and manages to escape from danger yet again.',
                'cover' => 'storage/files/books/7/cover/cover1656672639-The_GRUFFALO(2).pdf',
                'slug' => 'the-gruffalo2',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/7/1656672639-The_GRUFFALO(2).pdf',
                'numberPages'=> '32',
                'activity' => 'Draw or paint your own imaginary creature.',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'title' => 'Monkey Puzzle2',   /*However, Butterfly cannot seem to understand that Monkey and his mum look alike, so attempts to reunite Monkey with an elephant, a parrot and even a bat!*/
                'summary' => 'Monkey is lost in the jungle, so he asks Butterfly to help him find his mum.However, Butterfly cannot seem to understand that Monkey and his mum look alike, so attempts to reunite Monkey with an elephant, a parrot and even a bat!',
                'cover' => 'storage/files/books/8/cover/cover1656672667-MonkeyPuzzle_JuliaDonaldson.pdf',
                'slug' => 'monkey-puzzle2',
                'illustrator' => 'Axel Scheffler',
                'book_url' => 'storage/files/books/8/1656672667-MonkeyPuzzle_JuliaDonaldson.pdf',
                'numberPages'=> '36',
                'activity'=>'Draw / paint a jungle scene using the illustrations for inspiration.',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'title' => 'The Colour Monster2',/*He is red, green, yellow, blue and black, all at the same time. It`s making him very confused and he doesn`t know why*/
                'summary' => 'The little colour monster is having a hard time, as his feelings are all jumbled up.He is red, green, yellow, blue and black, all at the same time. It`s making him very confused and he doesn`t know why.',
                'cover' => 'storage/files/books/5/cover/cover1656672485-TheColourMonsterBook.pdf',
                'slug' => 'the-colour-monster2',
                'illustrator' => '',
                'book_url' => 'storage/files/books/5/1656672485-TheColourMonsterBook.pdf',
                'numberPages'=> '43',
                'activity' => 'Write a sequel. What adventures might the Colour Monster have next?',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);





        foreach (Book::all() as $book) {
            $users = User::inRandomOrder()->take(rand(10, 20))->pluck('id');
            foreach ($users as $user) {
                $book->users()->attach($user, ['read_date' => now(),'rating'=>random_int(1,5)]);
            }
        }


    }
}
