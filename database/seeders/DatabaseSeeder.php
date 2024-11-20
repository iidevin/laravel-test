<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Goods;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => Hash::make('123456'),
         ]);
        User::factory()->create([
            'name' => 'guest',
            'email' => 'guest@example.com',
            'password' => Hash::make('123456'),
        ]);

        Goods::factory(50)->create();

        //run other Seeder
        $this->call([
            PermissionsSeeder::class,
        ]);
    }
}
