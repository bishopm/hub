<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('residents', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('resident');
            $table->string('slug');
            $table->string('website')->nullable();
            $table->string('contact')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();
            $table->string('friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            $table->boolean('publish')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('residents');
    }
};
