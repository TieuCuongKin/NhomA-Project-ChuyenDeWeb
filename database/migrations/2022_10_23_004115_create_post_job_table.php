<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_job', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title');
            $table->integer('company_id');
            $table->integer('job_type_id');
            $table->string('location_id');
            $table->integer('job_salary_min');
            $table->integer('job_salary_max');
            $table->text('job_description', 1500);
            $table->timestamp('job_posting_date');
            $table->date('job_expired_at');
            $table->tinyInteger('job_status');
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
        Schema::dropIfExists('post_job');
    }
}
