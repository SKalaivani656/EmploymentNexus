<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postjobs', function (Blueprint $table) {
            $table->id();

            $table->string('title', 256)->unique()->index();
            $table->string('subtitle', 256);
            $table->string('slug', 256)->unique();
            $table->text('short_description');
            $table->longText('body');

            $table->integer('sector');

            // $table->integer('like')->nullable();
            // $table->integer('dislike')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();

            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->integer('min_sal')->nullable();
            $table->integer('max_sal')->nullable();
            $table->integer('min_exp')->nullable();
            $table->integer('max_exp')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();

            // $table->string('salary')->nullable();
            // $table->string('experience')->nullable();
            // $table->string('agelimit')->nullable();

            $table->string('image')->nullable();
            $table->string('image_alttag')->nullable();
            $table->string('video_link')->nullable(); // 0 - Inactive 1 - active

            $table->timestamp('postdate')->nullable();
            $table->timestamp('documentsubmissiondate')->nullable();
            $table->timestamp('startdateapply')->nullable();
            $table->timestamp('lastdateapply')->nullable();
            $table->timestamp('extendeddateapply')->nullable();
            $table->timestamp('examdate')->nullable();
            $table->timestamp('interviewdate')->nullable();
            $table->timestamp('finalresultdate')->nullable();
            $table->timestamp('dateofjoining')->nullable();

            $table->integer('total_vacancy')->nullable();

            $table->integer('position')->nullable();
            $table->boolean('is_top')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('jobcomment')->default(true);
            $table->boolean('image_status')->default(false);
            $table->boolean('video_status')->default(false);

            $table->dateTime('posted_on');

            $table->string('jobid')->nullable();
            $table->foreignId('companyjob_id')->nullable();
            $table->string('streetaddress')->nullable();
            $table->integer('postcode')->nullable();
            $table->integer('salarytype')->nullable();
            $table->string('workhours')->nullable();
            $table->string('responsibility')->nullable();

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
        Schema::dropIfExists('postjobs');
    }
}
