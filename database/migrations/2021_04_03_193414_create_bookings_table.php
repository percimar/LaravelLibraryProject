<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Database\Factories\BookingFactory;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date("booking_date");
            $table->date("approved_date")->nullable();
            $table->datetime("timeslot");
            $table->foreignId('room_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });

        $factory = new BookingFactory;
        $factory->count(30)->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
