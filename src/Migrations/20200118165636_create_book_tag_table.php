<?php

use App\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookTagTable extends Migration
{
    public function up()
    {
        $this->schema->create('book_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('book_tag');
    }
}
