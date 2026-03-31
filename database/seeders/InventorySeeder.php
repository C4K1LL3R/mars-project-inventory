<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{

    public function run(): void
{
    
    $cat1 = \App\Models\Category::create(['name' => 'Periféricos', 'description' => 'Ratos e teclados']); 
    $cat2 = \App\Models\Category::create(['name' => 'Monitores', 'description' => 'Ecrãs de alta resolução']);
    $cat3 = \App\Models\Category::create(['name' => 'Armazenamento', 'description' => 'Discos SSD e HDD']); 


    $p1 = \App\Models\Product::create([
        'category_id' => $cat1->id, 
        'name'        => 'Teclado Mecânico RGB',
        'sku'         => 'TEC-001', 
        'price'       => 89.90, 
        'stock'       => 15, 
    ]);

 
    \App\Models\StockMovement::create([
        'product_id' => $p1->id, 
        'type'       => 'in', 
        'quantity'   => 5, 
        'note'       => 'Reposição de stock semanal', 
    ]);
}
}
