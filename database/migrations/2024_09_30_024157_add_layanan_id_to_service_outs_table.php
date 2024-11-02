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
        Schema::table('service_outs', function (Blueprint $table) {
            $table->unsignedBigInteger('layanan_id')->after('customer_id')->nullable();
            $table->foreign('layanan_id')->references('id')->on('master_layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_outs', function (Blueprint $table) {
            $table->dropForeign(['layanan_id']);
            $table->dropColumn('layanan_id');
        });
    }
};
