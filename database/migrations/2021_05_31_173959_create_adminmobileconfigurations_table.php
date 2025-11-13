<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminmobileconfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminmobileconfigurations', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();

            $table->string('android_app_version');
            $table->string('ios_app_version');

            $table->integer('flag')->default(0);
            $table->integer('active_status')->default(0);
            $table->string('updated_id')->nullable();
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
        Schema::dropIfExists('adminmobileconfigurations');
    }
}
