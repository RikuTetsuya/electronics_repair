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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('cust_name', 200);
            $table->string('cust_address', 500);
            $table->string('cust_contact', 500);
            $table->string('item_name', 900);
            $table->string('item_brand', 100);
            $table->string('problem', 900);
            $table->tinyInteger('status')->default(0)->comment('0:waiting..., 1:rejected; 2:accepted; 3:finished;');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};