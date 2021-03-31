<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Factories\BookFactory;
use App\Models\Book;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->unsignedBigInteger("isbn", false);
            $table->text("author");
            $table->text("category");
            $table->text("image")->default("https://picsum.photos/200/300");
            $table->integer("pages", false, false);
            $table->date("publication");
        });
        $books = new BookFactory;
        $books->count(10)->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
