<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cus_id');
            $table->string('produet_id');
            $table->string('user_id');
            $table->string('newdate_ma');
            $table->string('outdate_ma');
            $table->string('store_name_id');
            $table->string('cloud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ma_customers');
    }
}
