<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('CASCADE');
            $table->foreignId('calendar_id')->nullable()->constrained('calendars')->onDelete('CASCADE');

            $table->enum('approvedBy', \App\Enums\AttendanceApprover::getValues())->nullable();

            $table->unsignedBigInteger('approverId')->nullable();
            $table->foreign('approverId')->references('parent_id')->on('users')->onDelete('CASCADE');

            $table->enum('status', \App\Enums\AttendanceStatus::getValues())->nullable();
            $table->boolean('isQRCode')->default(0);
            $table->string('gps_lat')->nullable();
            $table->string('gps_long')->nullable();
            $table->time('clock_in_time');
            $table->time('clock_out_time');
            $table->text('note')->nullable();
            $table->text('task_plan')->nullable();
            $table->text('task_report')->nullable();
            $table->boolean('isOvertime')->default(0);
            $table->integer('overtimeDuration')->nullable();
            $table->boolean('isApproved')->default(0);

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
        Schema::dropIfExists('attendances');
    }
}
