<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('day');
            $table->string('day_name');
            $table->unsignedBigInteger('month');
            $table->string('month_name');
            $table->unsignedBigInteger('year');
            $table->text('description');
            $table->enum('status', \App\Enums\CalendarStatus::getValues())->default(\App\Enums\CalendarStatus::WEEK_DAY);
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
        Schema::dropIfExists('calendars');
    }
}
