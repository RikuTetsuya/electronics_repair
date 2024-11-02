<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('service_ins', function (Blueprint $table) {
            // Menambahkan kolom order_id tanpa constraint unique terlebih dahulu
            $table->string('order_id')->after('id')->nullable(); 
        });

        // Isi kolom order_id dengan nilai unik
        DB::table('service_ins')->get()->each(function ($record) {
            DB::table('service_ins')
                ->where('id', $record->id)
                ->update(['order_id' => 'ORDER-' . strtoupper(Str::random(8))]);
        });

        // Setelah kolom terisi dengan nilai unik, tambahkan constraint unique
        Schema::table('service_ins', function (Blueprint $table) {
            $table->unique('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('service_ins', function (Blueprint $table) {
            $table->dropUnique(['order_id']);
            $table->dropColumn('order_id');
        });
    }
};
