<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photoname');
            $table->string('description');            
            $table->unsignedInteger('gallery_id');
            $table->foreign('gallery_id')->references('id')->on('gallery');  
            $table->string('photourl')->default('');            
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
        //
        //Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('photos');
    }
}
