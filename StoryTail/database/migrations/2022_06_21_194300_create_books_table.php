<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('title')->unique();
            $table->text('summary');
            $table->string('cover')->nullable(); // check if it is necessary
            $table->string('slug');
            $table->string('numberPages')->nullable();
            $table->double('averageRating')->nullable()->default(0);
            $table->string('activity')->nullable();
            $table->string('book_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('illustrator')->nullable();
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
        Schema::dropIfExists('books');
    }
}
