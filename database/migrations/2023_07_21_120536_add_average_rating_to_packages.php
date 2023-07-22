<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class AddAverageRatingToPackages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::table('packages', function (Blueprint $table) {
        $table->float('averageRating')->default(0); // Add a new 'averageRating' column to the 'packages' table
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
};
