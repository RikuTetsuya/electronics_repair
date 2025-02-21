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
            $table->integer('rating')->nullable()->after('status_payment');
            $table->text('feedback')->nullable()->after('rating');
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
