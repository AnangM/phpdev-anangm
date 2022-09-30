<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $data = [
            "name" => $faker->firstName(),
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => json_encode([
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ]),
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url"=>$faker->url()
        ];

        Candidate::create($data);
    }
}
