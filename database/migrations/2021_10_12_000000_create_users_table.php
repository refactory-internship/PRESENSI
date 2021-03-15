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

            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('CASCADE');
            $table->foreignId('division_office_id')->nullable()->constrained('division_office')->onDelete('CASCADE');
            $table->foreignId('time_setting_id')->nullable()->constrained('time_settings')->onDelete('CASCADE');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isAutoApproved')->default(0);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
           $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('CASCADE');
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
