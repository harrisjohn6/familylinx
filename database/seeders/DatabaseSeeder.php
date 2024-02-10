<?php
namespace Database\Seeders;

use Database\Seeds\RelationshipsTableSeeder;
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

        //$this->call([GendersTableSeeder::class,""]);
        $this->call([RelationshipsTableSeeder::class, ""]);
    }
}
