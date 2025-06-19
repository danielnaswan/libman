<?php

namespace Database\Seeders;

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
        DB::beginTransaction();

        try {
            // Insert users
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'Daniel Naswan',
                    'email' => 'ai220367@student.uthm.edu.my',
                    'password' => Hash::make('secret'),
                    'user_type' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2,
                    'name' => 'Amyza Apiva',
                    'email' => 'ai220364@student.uthm.edu.my',
                    'password' => Hash::make('secret'),
                    'user_type' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 3,
                    'name' => 'Juwairiah Muhammad Sin',
                    'email' => 'ai220365@student.uthm.edu.my',
                    'password' => Hash::make('secret'),
                    'user_type' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 4,
                    'name' => 'Iswanaziera Ismail',
                    'email' => 'ai220030@student.uthm.edu.my',
                    'password' => Hash::make('secret'),
                    'user_type' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 5,
                    'name' => 'member',
                    'email' => 'member@softui.com',
                    'password' => Hash::make('secret'),
                    'user_type' => 'member',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

            // Insert admin
            DB::table('admins')->insert([
                [
                    'id' => 1,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2,
                    'user_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 3,
                    'user_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 4,
                    'user_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            // Insert member
            DB::table('members')->insert([
                'id' => 1,
                'user_id' => 5,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th; // It's good practice to re-throw the exception after rollback
        }
    }
}