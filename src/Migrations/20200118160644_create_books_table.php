<?php

use App\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration
{
    public function up()
    {
        $this->schema->create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('isbn');
            $table->string('name');
            $table->string('poster');
            $table->string('url');
            $table->float('price');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('books');
    }
}