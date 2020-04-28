<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupdata = [
            ['name' => 'admin'],
            ['name' => 'asosiasi'],
            ['name' => 'perusahaan'],
            ['name' => 'professional'],
            ['name' => 'user']
        ];

        DB::table('groups')->insert($groupdata);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'group_id' => 1,
            'have_profile' => 1,
            'verified' => 1,
            'token' => rand(10000,99999)
        ]);

        DB::table('users')->insert([
            'name' => 'asosiasi',
            'email' => 'asosiasi@email.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'group_id' => 2,
            'have_profile' => 1,
            'verified' => 1,
            'token' => rand(10000,99999)
        ]);

        DB::table('users')->insert([
            'name' => 'perusahaan',
            'email' => 'perusahaan@email.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'group_id' => 3,
            'have_profile' => 1,
            'token' => rand(10000,99999)
        ]);

        DB::table('users')->insert([
            'name' => 'professional',
            'email' => 'professional@email.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'group_id' => 4,
            'have_profile' => 1,
            'token' => rand(10000,99999)
        ]);
    }
}
