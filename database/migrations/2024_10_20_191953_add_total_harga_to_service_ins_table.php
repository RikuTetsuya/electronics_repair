<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('service_ins', function (Blueprint $table) {
            $table->decimal('total_harga', 15, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('service_ins', function (Blueprint $table) {
            $table->dropColumn('total_harga');
        });
    }
};
