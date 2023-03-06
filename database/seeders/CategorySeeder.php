<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => "Startup",
                'slug' => "startup"
            ],
            [
                'name' => "Life",
                'slug' => "life"
            ],
            [
                'name' => "Technology",
                'slug' => "technology"
            ],
            [
                'name' => "Programming",
                'slug' => "programming"
            ],
            [
                'name' => "Gaming",
                'slug' => "gaming"
            ],
            [
                'name' => "Film",
                'slug' => "film"
            ],
            [
                'name' => "Travel",
                'slug' => "travel"
            ],
            [
                'name' => "Education",
                'slug' => "education"
            ],
            [
                'name' => "Relationship",
                'slug' => "relationship"
            ],
            [
                'name' => "UI/UX",
                'slug' => "ui/ux"
            ],
            [
                'name' => "Design",
                'slug' => "design"
            ],
        ]);
    }
}
