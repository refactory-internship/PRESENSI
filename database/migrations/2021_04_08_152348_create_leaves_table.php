<?php

use App\Enums\AttendanceApprover;
use App\Enums\LeaveStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()
                ->onDelete('CASCADE');

            $table->enum('approvedBy', AttendanceApprover::getValues())->nullable();

            $table->unsignedBigInteger('approverId')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('note')->nullable();

            $table->enum('approvalStatus', LeaveStatus::getValues())
                ->default(LeaveStatus::NEEDS_APPROVAL);
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
        Schema::dropIfExists('leaves');
    }
}
