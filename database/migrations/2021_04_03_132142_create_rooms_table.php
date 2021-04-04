<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->string("location");
            $table->string("description");
            $table->string("image_url");
        });

        DB::table('rooms')->insert([
            ['location' => '10.1.1', 'type' => 'Study Room', 'description' => 'A small quiet room for 1-2 people. Only contains a desk, two chairs and a whiteboard.', 'image_url' => 'images/studyRoom.jpg'],
            ['location' => '10.1.2', 'type' => 'Study Room', 'description' => 'A small quiet room for 1-2 people. Only contains a desk, two chairs and a whiteboard.', 'image_url' => 'images/studyRoom.jpg'],
            ['location' => '10.1.3', 'type' => 'Study Room', 'description' => 'A small quiet room for 1-2 people. Only contains a desk, two chairs and a whiteboard.', 'image_url' => 'images/studyRoom.jpg'],
            ['location' => '10.2.1', 'type' => 'Group Study Room', 'description' => 'Medium sized room for groups of 3-8. Contains a large desk, eight chairs, interactive whiteboard and projector.', 'image_url' => 'images/groupStudyRoom.jpg']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
