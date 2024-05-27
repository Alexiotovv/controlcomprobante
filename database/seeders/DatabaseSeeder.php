<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'alex',
            'email' => 'alex@gmail.com',
            'password' => Hash::make('rancio#763'),
        ]);
        DB::table('clientes')->insert([
            'nombre'=>'CONTRALORIA',
        ],
        [
            'nombre'=>'PODER JUDICIAL',
        ]);

        



    }
}
