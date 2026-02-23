<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
    Role::create([
        'name' => 'Admin',
        'description' => 'This is an administrator',
    ]);

        Role::create([
            'name' => 'User',
            'description' => 'This is a user',
        ]);
        Role::create([
        'name' => 'Staff',
        'description' => 'This is a staff',
    ]);
    Role::create([
        'name' => 'Trainer',
        'description' => 'This is a trainer',
    ]);
    }
    }

