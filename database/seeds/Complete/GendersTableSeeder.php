<?php
namespace Database\Seeds;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class GendersTableSeeder extends Seeder
{
    public function run()
    {

        $data = [
            ['gender_identity' => 'Female'],
            ['gender_identity' => 'Male'],
            ['gender_identity' => 'Non-binary'],
            ['gender_identity' => 'Genderqueer'],
            ['gender_identity' => 'Agender'],
            ['gender_identity' => 'Genderfluid'],
            ['gender_identity' => 'Transgender'],
            ['gender_identity' => 'Prefer not to say'],
            ['gender_identity' => 'Other'],
        ];

        DB::table('genders')->insert($data);

        logger()->debug('Inserted gender data:', $data);
    }
}
