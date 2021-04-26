<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->string('name');
            $table->string('liter')->nullable();
            $table->string('price');
            $table->longText('photo')->nullable();
            $table->longText('description');
            $table->foreignId('country_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('car_id')->nullable();
            $table->foreignId('color_id')->nullable();


            //user
            $table->foreignId('user_id')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
