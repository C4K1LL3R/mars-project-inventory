<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
       Schema::create('apps', function(Blueprint $table){
           $table->timestamps();
            $table-> string('name');
            $table ->decimal('price', 8,2);
            $table ->text('description')->nullable();});
      
    }

    public function down(): void
    {
            Schema::dropIfExists('aps');
    }
};
