<?php

use App\Enums\AttendanceApprover;
use App\Enums\OvertimeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')
                ->onDelete('CASCADE');
            $table->foreignId('calendar_id')->nullable()->constrained('calendars')
                ->onDelete('CASCADE');

            $table->enum('approvedBy', AttendanceApprover::getValues())->nullable();

            $table->unsignedBigInteger('approverId')->nullable();

            $table->string('task_plan')->nullable();
            $table->time('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->text('note')->nullable();
            $table->time('end_time')->nullable();
            $table->string('task_report')->nullable();
            $table->boolean('isFinished')->default(0);

            $table->enum('approvalStatus', OvertimeStatus::getValues())->nullable();
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
        Schema::dropIfExists('overtimes');
    }
}
