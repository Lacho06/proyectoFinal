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
        User::create([
            'name' => 'David',
            'lastname' => 'Rodriguez',
            'solapin' => 'E322786',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '51234567',
            'role' => 'administrador',
        ]);

        User::factory(20)->create();

        for($i = 0; $i < 10; $i++){
            $plan = RestorationPlan::factory(1)->create();
            for($j = 0; $j < rand(2, 5); $j++){
                $authorData = Author::factory(1)->create();
                $author = Author::find($authorData->pluck('id')->toArray())->first();

                $culturalWorkData = CulturalWork::factory(1)->create([
                    'author_id' => $author->id
                ]);

                $culturalWork = CulturalWork::find($culturalWorkData->pluck('id')->toArray())->first();

                $culturalWork->plans()->attach($plan->pluck('id')->toArray(), [
                    'start_date' => null,
                    'end_date' => null,
                ]);
            }
        }
    }
}
