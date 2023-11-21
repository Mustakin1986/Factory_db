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
        Schema::create('smv_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('style_no');
            $table->string('po_no')->nullable();
            $table->string('item');
            $table->string('item_description')->nullable();
            $table->float('costing_smv')->nullable();
            $table->float('bulk_smv');
            $table->string('remarks')->nullable();
            $table->string('smv_ref')->unique();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smv_libraries');
    }
};
