<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->time('start_time');  
            $table->time('end_time')->nullable();  
            $table->date('start_date');  
            $table->date('end_date')->nullable();  
            $table->string('phone');
            $table->text('address');
            $table->text('city');
            $table->string('state');
            $table->string('zip');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();   
            $table->integer('views')->default(0);
            $table->integer('status')->default(0);
            $table->integer('type')->default(0);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
