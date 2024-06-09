<?php

namespace Database\Seeders;

use App\Models\StoryTrigger;
use App\Services\AnimalService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;

class StoryTriggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker   = Faker\Factory::create();
        $animals = AnimalService::all();

        for ($i=0; $i<10; $i++) {
            $triger = new StoryTrigger();

            $triger->parameters = [
                'topic' => "friendship",
                'place' => "forest",
                'lang'  => rand(1, 99) % 2 == 1 ? "en" : "tr"
            ];

            $triger->characters = [
                [
                    "name" => $faker->firstName(),
                    "kind" => strtolower($animals[rand(0, count($animals)-1)])
                ],
                [
                    "name" => $faker->firstName(),
                    "kind" => strtolower($animals[rand(0, count($animals)-1)])
                ],
            ];

            $triger->status = 'new';

            $triger->save();
        }

    }
}
