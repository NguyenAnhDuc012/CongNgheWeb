<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->integer('sale_id')->primary()->autoIncrement();
            $table->integer('medicine_id');
            $table->integer('quantity');
            $table->dateTime('sale_date');
            $table->string('customer_phone', 10);
            $table->timestamps();
            $table->foreign('medicine_id')->references('medicine_id')->on('medicines')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
