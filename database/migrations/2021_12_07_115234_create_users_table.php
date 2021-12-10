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
                $table->string('phone_number')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->string('country_id')->nullable();
                $table->string('city_id')->nullable();
                $table->string('state_id')->nullable();
                $table->string('zip_code')->nullable();
                $table->string('profile_pic')->nullable();
                $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
                $table->foreignId('role_id')->constrained()->default("1"); 
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
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
