<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //['code', 'name','key',"table"]
        Schema::create('events', function (Blueprint $table) {
            $table->id();   // l id haka khassak dir lih   rah ty3tih lk automatik
            $table->timestamps(); // hta hadi katji automatik
            $table->integer('code'); 
            $table->string('name',250);
            $table->string('key',50);
            $table->string('table',50);
            $table->foreignId('user_id')->constrained('users');
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
