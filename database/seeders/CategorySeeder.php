<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

  public function run(): void
{
    $categories = [
        ['name' => 'Eletrónica', 'description' => 'Gadgets e dispositivos'],
        ['name' => 'Informática', 'description' => 'Computadores e acessórios'],
        ['name' => 'Eletrodomésticos', 'description' => 'Equipamento para casa'],
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create($category);
    }
}
}
