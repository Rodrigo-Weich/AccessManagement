<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            // USER
            ['police_name' => 'list-user', 'display_name' => 'List Users'],
            ['police_name' => 'create-user', 'display_name' => 'Create Users'],
            ['police_name' => 'update-user', 'display_name' => 'Update Users'],
            ['police_name' => 'delete-user', 'display_name' => 'Delete Users'],
            // ROLES
            ['police_name' => 'list-roles', 'display_name' => 'List Roles'],
            ['police_name' => 'create-roles', 'display_name' => 'Create Roles'],
            ['police_name' => 'update-roles', 'display_name' => 'Update Roles'],
            ['police_name' => 'delete-roles', 'display_name' => 'Delete Roles'],
            // CARDS
            ['police_name' => 'list-cards', 'display_name' => 'List Cards'],
            ['police_name' => 'create-cards', 'display_name' => 'Create Cards'],
            ['police_name' => 'update-cards', 'display_name' => 'Update Cards'],
            ['police_name' => 'delete-cards', 'display_name' => 'Delete Cards'],
            // CARD GROUPS
            ['police_name' => 'list-cardgroups', 'display_name' => 'List Card Groups'],
            ['police_name' => 'create-cardgroups', 'display_name' => 'Create Card Groups'],
            ['police_name' => 'update-cardgroups', 'display_name' => 'Update Card Groups'],
            ['police_name' => 'delete-cardgroups', 'display_name' => 'Delete Card Groups'],
            // NOTES
            ['police_name' => 'list-notes', 'display_name' => 'List Notes'],
            ['police_name' => 'create-notes', 'display_name' => 'Create Notes'],
            ['police_name' => 'update-notes', 'display_name' => 'Update Notes'],
            ['police_name' => 'delete-notes', 'display_name' => 'Delete Notes'],
            ['police_name' => 'show-notes', 'display_name' => 'Show Notes'],
        ]);
    }
}
