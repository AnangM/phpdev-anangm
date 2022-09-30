<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'candidate-create',
            'candidate-update',
            'candidate-read',
            'candidate-list',
            'candidate-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name'=>$permission, 'guard_name'=>'api']);
        }
    }
}
