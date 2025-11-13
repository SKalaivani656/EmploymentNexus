<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 60)->unique()->nullable();

            $table->string('father_name')->nullable();
            $table->timestamp('dob')->nullable();
            $table->timestamp('doj')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_two')->nullable();
            $table->text('address')->nullable();
            $table->string('edu_qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('previous_company')->nullable();
            $table->text('comments')->nullable();
            $table->integer('confirmed')->default(1);
            $table->boolean('is_accountactive')->nullable();
            $table->string('slack', 100)->nullable();
            $table->timestamp('dor')->nullable(); // date of relieving
            $table->string('relieving_reason')->nullable();

            // $table->string('bank_name')->nullable();
            // $table->string('account_no')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('branch')->nullable();
            // $table->string('pan_no')->nullable();
            // $table->string('aadhar_no')->nullable();

            $table->string('avatar')->nullable();
            $table->integer('role')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_session')->nullable();
            $table->text('remarks')->nullable();
            $table->string('uuid');
            $table->string('sys_id')->unique()->nullable();
            $table->string('uniqid')->unique()->nullable();
            $table->integer('sequence_id')->unique()->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('updated_id')->nullable();
            $table->integer('status')->default(0); // active
            $table->string('active')->default(0);
            $table->integer('flag')->default(0);
            $table->softDeletes();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
