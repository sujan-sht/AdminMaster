<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SujanSht\LaraAdmin\Models\Admin\Permission;
use SujanSht\LaraAdmin\Models\Admin\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models=['User','Role','Permission','Menu'];
        foreach($models as $model){
            Permission::create([
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'role_id' => Role::where('name','Super Admin')->first()->id,
                'model' => $model
            ]);
        }

    }
}
