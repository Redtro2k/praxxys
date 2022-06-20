<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = array('Laptop & Computer', 'Groceries', 'Man & Woman Accessories', 'Gaming', 'Mobile Accessories');
        foreach($names as $name){
            Category::create(['name' => $name]);
        }
    }
}
