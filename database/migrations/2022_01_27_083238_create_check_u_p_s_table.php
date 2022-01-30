<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckUPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->string("file");
            $table->text("notes")->nullable();
            $table->timestamps();

            // forgin key for sick user
            $table->unsignedBigInteger('sick_id');
            $table->foreign('sick_id')->references('id')->on('users');

            // forgin key for lab user
            $table->unsignedBigInteger('lab_id');
            $table->foreign('lab_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkups');
    }
}
