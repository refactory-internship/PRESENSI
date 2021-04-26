<?php

use App\Enums\AbsentStatus;
use App\Enums\AttendanceApprover;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')
                ->onDelete('CASCADE');
            $table->foreignId('calendar_id')->nullable()->constrained('calendars')
                ->onDelete('CASCADE');

            $table->enum('approvedBy', AttendanceApprover::getValues())->nullable();

            $table->unsignedBigInteger('approverId')->nullable();

            $table->date('date')->nullable();
            $table->text('reason')->nullable();

            $table->enum('approvalStatus', AbsentStatus::getValues())
                ->default(AbsentStatus::NEEDS_APPROVAL);
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
        Schema::dropIfExists('absents');
    }
}
