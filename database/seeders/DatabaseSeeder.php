<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'jacarrasco',
            'email' => 'jacarrasco@admindesk.com',
            'password' => bcrypt('admin'),
        ]);

        \App\Models\UserData::create([
            'user_id' => 1,
            'name' => 'José Antonio',
            'surnames' => 'Carrasco González',
            'phone' => '675-70-14-39',
            'province' => 'Huelva',
            'city' => 'Lepe',
            'postal_code' => '21440',
            'address' => 'Plz. Acebuche 1, 2ºC',
        ]);



        \App\Models\User::create([
            'username' => 'admin',
            'email' => 'admin@admindesk.com',
            'password' => bcrypt('admin')
        ]);

        \App\Models\UserData::create([
            'user_id' => 1,
            'name' => 'Administrador',
            'surnames' => 'AdminDesk',
            'phone' => '675-70-14-39',
            'province' => 'Huelva',
            'city' => 'Lepe',
            'postal_code' => '21440',
            'address' => 'Plz. Acebuche 1, 2ºC',
        ]);
    }
}
