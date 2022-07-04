<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([

            'name' => 'Isabel Ferreira',

            'account_type_id' => '1',
            'slug' => 'isabel-ferreira',
            /*'age' => '20/10/1990',*/

            'email'=>'storytailcolegiomaia@gmail.com',

            'active'=>true,

            'password'=>bcrypt('storytail2022'),

            'email_verified_at' => now(),


            'remember_token' => Str::random(10),

            'created_at' => now(),
            'updated_at' => now()

        ]);

        \DB::table('users')->insert([

            'name' => 'Ivo Carvalho',
            'slug' => 'ivo-carvalho',

            'account_type_id' => '1',

            /*'age' => '20/10/1990',*/

            'email'=>'ivo.carvalho.prt_a@msft.cesae.pt',

            'active'=>true,

            'password'=>bcrypt('123'),

            'email_verified_at' => now(),

            'remember_token' => Str::random(10),

            'created_at' => now(),
            'updated_at' => now()

        ]);

        \DB::table('users')->insert([

            'name' => 'Joaquim Neves',
            'slug' => 'joaquim-neves',

            'account_type_id' => '2',

            /*'age' => '20/10/1990',*/

            'email'=>'ivocesae2022@gmail.com',

            'active'=>true,

            'password'=>bcrypt('123'),

            'email_verified_at' => now(),

            'remember_token' => Str::random(10),

            'created_at' => now(),
            'updated_at' => now()

        ]);

        factory(User::class,20)->create();
    }
}
