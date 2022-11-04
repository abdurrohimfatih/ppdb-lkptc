<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 3,
            'remember_token' => Str::random(60),
            'created_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'pengawas',
            'email' => 'pengawas@gmail.com',
            'password' => Hash::make('pengawas'),
            'level' => 2,
            'remember_token' => Str::random(60),
            'created_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'level' => 1,
            'remember_token' => Str::random(60),
            'created_at' => now()
        ]);
    }
}
