<?php

use App\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration
{
    public function up()
    {
        $this->schema->create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('tags');
    }
}
