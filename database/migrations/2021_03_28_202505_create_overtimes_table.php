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
            $table->foreign('approverId')->references('parent_id')->on('users')
                ->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->time('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->time('end_time')->nullable();

            $table->text('task_plan')->nullable();
            $table->text('task_report')->nullable();
            $table->text('note')->nullable();

            $table->enum('approvalStatus', OvertimeStatus::getValues())
                ->default(OvertimeStatus::NEEDS_APPROVAL);
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
