<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
   
   public function run(): void
{
    $products = [
        ['name' => 'Rato Sem Fios', 'sku' => 'RAT-001', 'price' => 15.50, 'category_id' => 2, 'stock' => 50],
        ['name' => 'Teclado Mecânico', 'sku' => 'TEC-002', 'price' => 45.00, 'category_id' => 2, 'stock' => 20],
        ['name' => 'Monitor 24"', 'sku' => 'MON-003', 'price' => 120.00, 'category_id' => 2, 'stock' => 10],
        ['name' => 'Smartphone X', 'sku' => 'PHO-004', 'price' => 699.99, 'category_id' => 1, 'stock' => 15],
        ['name' => 'Auscultadores BT', 'sku' => 'AUD-005', 'price' => 55.00, 'category_id' => 1, 'stock' => 30],
        ['name' => 'Portátil Pro', 'sku' => 'LAP-006', 'price' => 1200.00, 'category_id' => 2, 'stock' => 5],
        ['name' => 'Micro-ondas', 'sku' => 'MIC-007', 'price' => 85.00, 'category_id' => 3, 'stock' => 8],
        ['name' => 'Torradeira', 'sku' => 'TOR-008', 'price' => 25.00, 'category_id' => 3, 'stock' => 12],
        ['name' => 'Cabo HDMI', 'sku' => 'CAB-009', 'price' => 8.50, 'category_id' => 2, 'stock' => 100],
        ['name' => 'Webcam HD', 'sku' => 'WEB-010', 'price' => 35.00, 'category_id' => 2, 'stock' => 25],
    ];

    foreach ($products as $product) {
        \App\Models\Product::create($product);
    }
}
}
