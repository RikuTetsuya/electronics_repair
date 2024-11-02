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
            $table->enum('status_payment', ['Unpaid', 'Paid']);
        });
    }

    public function down()
    {
        Schema::table('service_ins', function (Blueprint $table) {
            $table->dropColumn('status_payment');
        });
    }

};
