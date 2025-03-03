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
        Schema::table('service_ins', function (Blueprint $table) {
            $table->integer('perbaikan_pihak_ketiga')->comment('0:waiting, 1:no, 2:yes')->default('0')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_ins', function (Blueprint $table) {
            //
        });
    }
};
