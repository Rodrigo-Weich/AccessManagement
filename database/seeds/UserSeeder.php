<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Preview User 1',
                'email' => 'previewuser1@thribbe.com',
                'password' => Hash::make('previewuser'),
                'unalterable' => 1
            ]
        ]);
    }
}
