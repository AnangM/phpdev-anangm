<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\User;
use Faker\Factory;
use Laravel\Passport\Passport;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Tests\TestCase;

class CandidateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_candidate()
    {

        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);

        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "name" => $faker->firstName(),
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->post('/api/candidates', $body, $headers);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id'
        ]);
    }

    public function test_create_candidate_with_invalid_input()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->post('/api/candidates', $body, $headers);

        $response->assertStatus(400);
    }

    public function test_hr_create_candidate()
    {

        $user = User::where('email', 'lee.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "name" => $faker->firstName(),
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->post('/api/candidates', $body, $headers);

        $response->assertStatus(403);
    }

    public function test_list_candidate()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $headers = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->get('/api/candidates', $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                '*' => [
                    'id'
                ]
            ]
        ]);
    }

    public function test_read_candidate()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $candidate = Candidate::first();

        $headers = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->get("/api/candidates/$candidate->id", $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "id"
        ]);
    }

    public function test_read_candidate_with_invalid_id()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $faker = Factory::create();
        $uuid = $faker->uuid();
        $headers = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->get("/api/candidates/$uuid", $headers);
        $response->assertStatus(404);
    }

    public function test_hr_update_candidate()
    {
        $user = User::where('email', 'lee.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $candidate =  Candidate::first();

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "name" => $faker->firstName(),
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->put("/api/candidates/$candidate->id", $body, $headers);

        $response->assertStatus(403);
    }

    public function test_update_candidate()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $candidate =  Candidate::first();

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "name" => "Updated Name",
            "education" => $faker->lastName() . " University",
            "birthday" => "2000-03-10",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->put("/api/candidates/$candidate->id", $body, $headers);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "name" => "Updated Name"
        ]);
    }

    public function test_update_candidate_with_invalid_value()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $candidate =  Candidate::first();

        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();

        $body = [
            "name" => "Updated Name",
            "education" => $faker->lastName() . " University",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->put("/api/candidates/$candidate->id", $body, $headers);

        $response->assertStatus(400);
    }

    public function test_update_candidate_with_invalid_id()
    {
        $user = User::where('email', 'john.doe@mail.com')->first();

        Passport::actingAs($user);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;


        $headers = [
            "Authorization" => "Bearer $token"
        ];

        $faker = Factory::create();
        $uuid = $faker->uuid();

        $body = [
            "name" => "Updated Name",
            "education" => $faker->lastName() . " University",
            "experience" => "5 years",
            "last_position" => $faker->jobTitle(),
            "applied_position" => $faker->jobTitle(),
            "top_skills" => [
                "json",
                "rest api",
                "php",
                "js",
                "java"
            ],
            "email" => $faker->email(),
            "phone" => $faker->phoneNumber(),
            "resume_url" => $faker->filePath()
        ];

        $response = $this->put("/api/candidates/$uuid", $body, $headers);

        $response->assertStatus(400);
    }
}
