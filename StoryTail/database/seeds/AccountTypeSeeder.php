<?php

use Illuminate\Database\Seeder;
use APP\AccountType;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \DB::table('account_types')->insert([
            [
                'type' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'student',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
