<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Dairy', 'slug' => 'dairy']);
        Category::create(['name' => 'Beverages', 'slug' => 'beverages']);
        Category::create(['name' => 'Snacks', 'slug' => 'snacks']);
        Category::create(['name' => 'Canned Goods', 'slug' => 'canned-goods']);
    }
}