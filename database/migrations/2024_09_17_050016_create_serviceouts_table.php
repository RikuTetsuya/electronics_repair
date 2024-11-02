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
        Schema::create('service_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_in_id');
            $table->foreign('service_in_id')->references('id')->on('service_ins');
            $table->dateTime('tanggal_keluar');
            $table->dateTime('tanggal_diterima')->nullable();
            $table->decimal('biaya', 10, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_outs');
    }
};
