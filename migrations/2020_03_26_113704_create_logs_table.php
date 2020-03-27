<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitwise_logger_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level_name');
            $table->string('exception')->nullable()->index();
            $table->string('channel');
            $table->dateTime('log_time')->index();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('origin')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent',512)->nullable();
            $table->text('request_url')->nullable();
            $table->text('path')->nullable();
            $table->text('request_data')->nullable();
            $table->text('method')->nullable();
            $table->text('stack_trace')->nullable();
            $table->text('message')->nullable();
            $table->string('line_no')->nullable();
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('bitwise_logger_logs');
    }
}
