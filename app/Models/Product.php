<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['category_id', 'name', 'sku', 'barcode', 'price', 'stock', 'ean'];

public function category() {
    return $this->belongsTo(Category::class);
}

public function stockMovements() {
    return $this->hasMany(StockMovement::class);
}
}
