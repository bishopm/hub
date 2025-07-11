<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('churches', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('church');
            $table->string('slug');
            $table->string('website')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('contact')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('publish')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('churches');
    }
};
