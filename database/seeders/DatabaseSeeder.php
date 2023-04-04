<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\CulturalWork;
use App\Models\RestorationPlan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'David',
            'lastname' => 'Rodriguez',
            'solapin' => 'E322786',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '51234567',
            'role' => 'administrador',
        ]);

        User::factory(20)->create();
        Author::factory(10)->create();
        RestorationPlan::factory(10)->create();
        for($i = 1; $i <= 10; $i++){
            CulturalWork::factory(10)->create([
                'author_id' => $i,
                'restoration_plan_id' => $i
            ]);
        }
    }
}
