<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $john = User::create([
            'name' => 'Mr. John',
            'email' => 'john.doe@mail.com',
            'password' => Hash::make('password'),
            'email_verified_at'=>Carbon::now()
        ]);

        $lee = User::create([
            'name' => 'Mrs. Lee',
            'email' => 'lee.doe@mail.com',
            'password' => Hash::make('password'),
            'email_verified_at'=>Carbon::now()
        ]);

        $seniorPermissions = Permission::pluck('id', 'id')->all();

        $hrPermissions = Permission::whereIn('name',  ['candidate-read', 'candidate-list'])->get()->pluck('id','id');

        $seniorRole = Role::where('name', 'Senior HRD')->first();
        $hrRole = Role::where('name', 'HRD')->first();

        $seniorRole->syncPermissions($seniorPermissions);
        $hrRole->syncPermissions($hrPermissions);

        $john->assignRole([$seniorRole->id]);
        $lee->assignRole([$hrRole->id]);
    }
}
