<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Database\Factories\BlogCategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::factory()->count(50)->create();
    }
}
