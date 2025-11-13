<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminconfigurationkeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminconfigurationkeys', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();

            $table->string('email_from_name')->nullable();
            $table->string('email_from_mail')->nullable();
            $table->string('email_mail_driver')->nullable();
            $table->string('email_mail_host')->nullable();
            $table->string('email_mail_port')->nullable();
            $table->string('email_mail_username')->nullable();
            $table->string('email_mail_password')->nullable();
            $table->string('email_mail_encryption')->nullable();

            $table->boolean('mailchimpflag')->default(false);
            $table->string('mailchimpapikey')->nullable();
            $table->string('mailchimplistid')->nullable();

            $table->boolean('recaptchasecretstatus')->default(false);
            $table->string('recaptchasecretkey')->nullable();
            $table->string('recaptchasitekey')->nullable();

            $table->integer('searchstatus')->default(1);
            $table->string('algoliaapp')->nullable();
            $table->string('algoliasecret')->nullable();

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
        Schema::dropIfExists('adminconfigurationkeys');
    }
}
