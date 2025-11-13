<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();

            $table->string('uuid');
            $table->foreignId('user_id');
            $table->string('user_uniqid')->nullable();
            $table->string('name');
            $table->text('details'); // Track message
            $table->string('function')->nullable(); // Method describe
            $table->string('portal')->nullable();
            $table->integer('flag')->nullable();
            $table->integer('status')->nullable();
            $table->integer('active_status')->nullable();
            $table->string('panel'); // Admin, Jobseeker
            $table->string('sessionid');

            $table->softDeletes();
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
        Schema::dropIfExists('trackings');
    }
}
