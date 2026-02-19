<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
        'name' => 'Admin',
        'description' => 'System administrator',
    ]);

        Category::create([
            'name' => 'Trainer',
            'description' => 'Gym trainer',
        ]);
        Category::create([
        'name' => 'Staff',
        'description' => 'This is a staff',
    ]);
    }
}
