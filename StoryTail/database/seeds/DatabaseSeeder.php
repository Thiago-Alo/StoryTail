<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AccountTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(AgeGroupSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(ActivityTypeSeeder::class);
        $this->call(ThemeSeeder::class);

    }
}
