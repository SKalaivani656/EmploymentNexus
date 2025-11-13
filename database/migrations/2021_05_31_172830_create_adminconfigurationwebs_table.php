<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminconfigurationwebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminconfigurationwebs', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();

            $table->string('name')->nullable();
            $table->string('website')->nullable();
            $table->string('uplode_logo_image')->nullable();
            $table->string('favicon_image')->nullable();
            $table->string('timezone')->nullable();
            $table->string('dateformate')->nullable();
            $table->string('dateformat_javascript')->nullable();
            $table->string('websitetheme')->nullable();
            $table->integer('blogtemplates')->default(0);

            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('address_three')->nullable();
            $table->string('address_four')->nullable(); // optional
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();

            $table->string('bank_accountname')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch')->nullable();

            $table->string('theme_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('background_color')->nullable();

            $table->string('headerbg_color')->nullable();
            $table->string('headertext_color')->nullable();
            $table->string('footerbg_color')->nullable();
            $table->string('footertext_color')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('quora')->nullable();
            $table->string('medium')->nullable();
            $table->string('reddit')->nullable();

            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('copyrights')->nullable();

            $table->boolean('disqusflag')->default(false);
            $table->text('disquscode')->nullable();

            $table->string('googleanalyticsapi')->nullable();
            $table->text('googleanalyticscode')->nullable();

            $table->text('googleadsverticalcode')->nullable();
            $table->text('googleadshorizontalcode')->nullable();

            $table->text('socialmediaicon')->nullable(); //addthid

            $table->integer('flag')->default(0);
            $table->integer('active_status')->default(0);
            $table->integer('updated_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('adminconfigurationwebs');
    }
}
