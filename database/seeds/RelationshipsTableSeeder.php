<?php

namespace Database\Seeds;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert base relationship titles
        DB::table('relationships')->insert([
            ['relationship_title' => 'Parent'],
            ['relationship_title' => 'Child'],
            ['relationship_title' => 'Sibling'],
            ['relationship_title' => 'Spouse'],
            ['relationship_title' => 'Grandparent'],
            ['relationship_title' => 'Grandchild'],
            ['relationship_title' => 'Uncle/Aunt'],
            ['relationship_title' => 'Nephew/Niece'],
            ['relationship_title' => 'Cousin'],
            ['relationship_title' => 'Step-Parent'],
            ['relationship_title' => 'Step-Child'],
            ['relationship_title' => 'Step-Sibling'],
            ['relationship_title' => 'Half-Sibling'],
            ['relationship_title' => 'Partner'],
            ['relationship_title' => 'Guardian'],
            ['relationship_title' => 'Godparent'],
            ['relationship_title' => 'Adopted Child'],
            ['relationship_title' => 'Adoptive Parent'],
            ['relationship_title' => 'Foster Parent'],
            ['relationship_title' => 'Foster Child'],
            ['relationship_title' => 'In-Law'],
        ]);

        // Update parent_flag for specific titles
        DB::table('relationships')
            ->whereIn('relationship_title', ['Parent', 'Step-Parent', 'Adoptive Parent', 'Foster Parent'])
            ->update(['isParent' => 1]);

        // Update includes_step for specific titles
        DB::table('relationships')
            ->whereIn('relationship_title', ['Step-Parent', 'Step-Child', 'Step-Sibling'])
            ->update(['includes_step' => 1]);

        // Update includes_half for specific titles
        DB::table('relationships')
            ->whereIn('relationship_title', ['Half-Sibling'])
            ->update(['includes_half' => 1]);
    }
}
