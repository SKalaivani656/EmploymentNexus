<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostblogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postblogs', function (Blueprint $table) {
            $table->id();

            $table->string('title', 256)->unique()->index();
            $table->string('subtitle', 256)->nullable();
            $table->string('slug', 256)->unique();
            $table->text('short_description');
            $table->longText('body');

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('image')->nullable();
            $table->string('image_alttag')->nullable();
            $table->string('video_link')->nullable();

            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->integer('position');
            $table->boolean('is_top')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('image_status')->default(false);
            $table->boolean('video_status')->default(false);
            $table->boolean('blogcomment')->default(true);

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
        Schema::dropIfExists('postblogs');
    }
}
