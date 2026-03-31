<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 use Illuminate\Support\Facades\DB;

return new class extends Migration
{

   
public function up(): void
{
    DB::unprepared('
        CREATE TRIGGER after_stock_movement_insert
        AFTER INSERT ON stock_movements
        FOR EACH ROW
        BEGIN
            IF NEW.type = "entrada" THEN
                UPDATE products 
                SET stock = stock + NEW.quantity 
                WHERE id = NEW.product_id;
            ELSEIF NEW.type = "saida" THEN
                UPDATE products 
                SET stock = stock - NEW.quantity 
                WHERE id = NEW.product_id;
            END IF;
        END
    ');
}

public function down(): void
{
    DB::unprepared('DROP TRIGGER IF EXISTS after_stock_movement_insert');
}
};
