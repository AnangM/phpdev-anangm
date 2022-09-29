<?php

namespace Tests\Feature;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPSTORM_META\map;

class OauthTest extends TestCase
{
    use RefreshDatabase;
    
    function test_oauth_get_token(){
        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);




        $result = $this->post('/oauth/token', [
            "grant_type"=>'password',
            "client_id"=>'',
            "client_secret"=>'',
            "username"=>'',
            "password"=>'',
            "scope"=>''
        ]);

        $result->assertStatus(400);
    }
}
