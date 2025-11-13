<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostvideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postvideos', function (Blueprint $table) {
            $table->id();

            $table->string('title', 256)->unique()->index();
            $table->text('body');

            $table->string('video_id')->nullable();
            $table->string('link')->nullable();
            $table->string('img_link')->nullable();
            $table->string('download_link')->nullable();

            $table->string('slug', 256)->unique();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();

            $table->integer('position');
            $table->boolean('is_top')->default(false);
            $table->boolean('is_popular')->default(false);

            $table->boolean('video_status')->default(false);
            $table->boolean('videocomment')->default(true);

            $table->dateTime('posted_on');
            $table->text('schemaorg')->nullable();

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
        Schema::dropIfExists('postvideos');
    }
}
