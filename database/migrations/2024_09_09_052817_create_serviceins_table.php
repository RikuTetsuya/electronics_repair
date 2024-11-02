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
        Schema::create('service_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('master_customers');
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('layanan_id')->references('id')->on('master_layanans');
            $table->dateTime('tanggal_masuk');
            $table->text('deskripsi_masalah');
            $table->integer('status')->default(0)->comment('0:waiting..., 1:rejected; 2:accepted; 3:in progress; 4:finished');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_ins');
    }
};
