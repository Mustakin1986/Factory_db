<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('efficiencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unite_id');
            $table->integer('Line_No')->nullable();
            $table->integer('Ttl_OP')->nullable();
            $table->integer('Ttl_HP')->nullable();
            $table->integer('Working_Hrs')->nullable();
            $table->String('style_no')->nullable();
            $table->String('Po_No')->nullable();
            $table->String('Item')->nullable();
            $table->String('smv')->nullable();
            $table->integer('Today_Target')->nullable();
            $table->integer('Today_Output')->nullable();
            $table->String('remarks')->nullable();
            $table->String('efficiency_ref')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efficiencies');
    }
};
