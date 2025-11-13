<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobnavlinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobnavlinks', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique()->index();
            $table->string('shortname')->unique();
            $table->string('link')->nullable();

            $table->integer('position');
            $table->boolean('is_top')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_footer')->default(false);

            $table->text('remarks')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->string('uuid')->unique();
            $table->integer('sequence_id');
            $table->foreignId('user_id');
            $table->string('created_by');
            $table->string('updated_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('active');
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('jobnavlinks');
    }
}
