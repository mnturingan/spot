<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert
        ([
            //Admin
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('adminpass'),
                'user_type' => 'admin',
            ],

            //User
            [
                'name' => 'Mark Turingan',
                'email' => 'mnturingan@student.apc.edu.ph',
                'password' => Hash::make('userpass'),
                'user_type' => 'user'
            ]
        ]);
    }
}
