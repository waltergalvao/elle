<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_logs', function (Blueprint $table) {
            $table->id();
            $table->string('contact_email')->nullable();
            $table->string('error')->nullable();
            $table->boolean('acknowledged')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreignId('batch_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_logs');
    }
}
