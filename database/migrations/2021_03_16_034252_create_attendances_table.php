<?php

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
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

            $table->foreignId('user_id')->nullable()->constrained('users')
                ->onDelete('CASCADE');
            $table->foreignId('calendar_id')->nullable()->constrained('calendars')
                ->onDelete('CASCADE');

            $table->enum('approvedBy', AttendanceApprover::getValues())->nullable();

            $table->unsignedBigInteger('approverId')->nullable();
            $table->foreign('approverId')->references('parent_id')->on('users')
                ->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->boolean('isQRCode')->default(0);
            $table->string('gps_lat')->nullable();
            $table->string('gps_long')->nullable();

            $table->string('task_plan')->nullable();
            $table->time('clock_in_time')->nullable();
            $table->text('note')->nullable();
            $table->string('task_report')->nullable();
            $table->time('clock_out_time')->nullable();
            $table->boolean('isFinished')->default(0);

            $table->enum('approvalStatus', ApprovalStatus::getValues())->nullable();
            $table->text('rejectionNote')->nullable();
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
