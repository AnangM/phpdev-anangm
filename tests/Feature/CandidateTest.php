<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\User;
use Database\Seeders\CandidateSeeder;
use Faker\Factory;
use Laravel\Passport\Passport;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CandidateTest extends TestCase
{

    use RefreshDatabase;

    public function setUp():void{
        parent::setUp();
        $this->seed();
        $this->seed(CandidateSeeder::class);
    }

    public function test_create_candidate()
    {

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
            "phone" => "012312312321",
            "resume" => "data:application/pdf;base64,JVBERi0xLjMKJcTl8uXrp/Og0MTGCjMgMCBvYmoKPDwgL0ZpbHRlciAvRmxhdGVEZWNvZGUgL0xlbmd0aCAxMTkgPj4Kc3RyZWFtCngBK1QIVChU0HcuNlRILlYwAMPiZKCQgZ6RCYQPYhhaKJhaGOtZGikk5yo4hQBlDQwMjBVCkhVMIXqAlJGRqYKpoSVXSK6CfkiIkYKhQkiagoaikrKipkJIloJrCNgq/OYiTDM2MtQzNLQwwmKkCsK8QABJcSgnCmVuZHN0cmVhbQplbmRvYmoKMSAwIG9iago8PCAvVHlwZSAvUGFnZSAvUGFyZW50IDIgMCBSIC9SZXNvdXJjZXMgNCAwIFIgL0NvbnRlbnRzIDMgMCBSIC9NZWRpYUJveCBbMCAwIDYxMiA3OTJdCj4+CmVuZG9iago0IDAgb2JqCjw8IC9Qcm9jU2V0IFsgL1BERiAvVGV4dCBdIC9Db2xvclNwYWNlIDw8IC9DczEgNSAwIFIgPj4gL0ZvbnQgPDwgL1RUMiA3IDAgUgo+PiA"
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
            "phone" => "08123123123",
            "resume" => "data:application/pdf;base64,JVBERi0xLjMKJcTl8uXrp/Og0MTGCjMgMCBvYmoKPDwgL0ZpbHRlciAvRmxhdGVEZWNvZGUgL0xlbmd0aCAxMTkgPj4Kc3RyZWFtCngBK1QIVChU0HcuNlRILlYwAMPiZKCQgZ6RCYQPYhhaKJhaGOtZGikk5yo4hQBlDQwMjBVCkhVMIXqAlJGRqYKpoSVXSK6CfkiIkYKhQkiagoaikrKipkJIloJrCNgq/OYiTDM2MtQzNLQwwmKkCsK8QABJcSgnCmVuZHN0cmVhbQplbmRvYmoKMSAwIG9iago8PCAvVHlwZSAvUGFnZSAvUGFyZW50IDIgMCBSIC9SZXNvdXJjZXMgNCAwIFIgL0NvbnRlbnRzIDMgMCBSIC9NZWRpYUJveCBbMCAwIDYxMiA3OTJdCj4+CmVuZG9iago0IDAgb2JqCjw8IC9Qcm9jU2V0IFsgL1BERiAvVGV4dCBdIC9Db2xvclNwYWNlIDw8IC9DczEgNSAwIFIgPj4gL0ZvbnQgPDwgL1RUMiA3IDAgUgo+PiA"
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
            "phone" => "081231231231",
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
            "phone" => "089123123123",
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
            "phone" => "081231231231"
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
            "phone" => "081231231231",
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
            "phone" => "081231231231",
            "resume_url" => $faker->filePath()
        ];

        $response = $this->put("/api/candidates/$uuid", $body, $headers);

        $response->assertStatus(400);
    }
}
