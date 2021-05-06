<?php

use App\Enums\AttendanceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_master', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')
                ->onDelete('CASCADE');
            $table->foreignId('attendance_id')->nullable()->constrained('attendances')
                ->onDelete('CASCADE');
            $table->foreignId('overtime_id')->nullable()->constrained('overtimes')
                ->onDelete('CASCADE');
            $table->foreignId('absent_id')->nullable()->constrained('absents')
                ->onDelete('CASCADE');
            $table->foreignId('leave_id')->nullable()->constrained('leaves')
                ->onDelete('CASCADE');

            $table->enum('attendance_type', AttendanceStatus::getValues())->nullable();
            $table->unsignedBigInteger('month')->nullable();
            $table->unsignedBigInteger('year')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_master');
    }
}
