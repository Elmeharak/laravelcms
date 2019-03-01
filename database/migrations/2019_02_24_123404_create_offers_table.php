<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('offer_id');
            $table->string('title');
            $table->text('description');
            $table->string('price');
            $table->string('image')->default('default.png');
//            $table->string('image');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('country_id')->on('countries')->onDelete('cascade');

            $table->integer('gov_id')->unsigned();
            $table->foreign('gov_id')->references('gov_id')->on('governorates')->onDelete('cascade');

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
        Schema::dropIfExists('offers');
    }
}
