<?php
namespace Database\Seeds;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class GendersTableSeeder extends Seeder
{
    public function run()
    {

        $data = [
            ['gender' => 'Female'],
            ['gender' => 'Male'],
            ['gender' => 'Non-binary'],
            ['gender' => 'Genderqueer'],
            ['gender' => 'Agender'],
            ['gender' => 'Genderfluid'],
            ['gender' => 'Transgender'],
            ['gender' => 'Prefer not to say'],
            ['gender' => 'Other'],
        ];

        DB::table('genders')->insert($data);

        logger()->debug('Inserted gender data:', $data);
    }
}
