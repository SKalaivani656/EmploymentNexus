<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('shortname')->nullable();

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alttag')->nullable();
            $table->boolean('is_image')->default(false);
            $table->foreignId('country_id');
            $table->string('uuid')->unique();
            $table->boolean('active')->default(true);
            $table->boolean('is_top')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('union_territories')->default(false);
            $table->boolean('is_mobile')->default(false);
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
        Schema::dropIfExists('states');
    }
}
