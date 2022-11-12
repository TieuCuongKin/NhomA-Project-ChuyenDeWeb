<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->String('full_name',150);
            $table->String('email',150)->unique();
            $table->String('password',150);
            $table->String('phone',11);
            $table->String('address',150);
            $table->timestamps();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->String('token',10)->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
