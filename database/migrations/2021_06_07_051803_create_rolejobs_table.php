<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolejobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolejobs', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique()->index();
            $table->string('shortname')->unique()->index();
            $table->string('slug')->unique();

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('image')->nullable();
            $table->string('image_alttag')->nullable();
            $table->boolean('is_image')->default(false);

            $table->integer('position');
            $table->boolean('is_leftsidemenu')->default(false);
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

        Schema::create('postjob_rolejob', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postjob_id') //$table->unsignedBigInteger('user_id');
                ->constrained() // $table->foreign('user_id')->references('id')->on('users');
                ->onUpdateCascade()
                ->onDeleteCascade(); // onDelete('cascade');

            $table->foreignId('rolejob_id')
                ->constrained()
                ->onUpdateCascade()
                ->onDeleteCascade();

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
        Schema::dropIfExists('rolejobs');
        Schema::dropIfExists('postjob_rolejob');
    }
}
