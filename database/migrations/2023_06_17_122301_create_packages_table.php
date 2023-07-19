<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            // $table->id('package_id');
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->integer('price');
            $table->float('discount')->nullable();
            $table->longText('description');
            $table->string('features');
            // $table->string('image');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
