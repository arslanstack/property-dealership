<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->string('amenity_icon1')->nullable();
            $table->string('amenity_icon2')->nullable();
            $table->string('amenity_icon3')->nullable();
            $table->string('amenity_title1')->nullable();
            $table->string('amenity_title2')->nullable();
            $table->string('amenity_title3')->nullable();
            $table->text('amenity_desc1')->nullable();
            $table->text('amenity_desc2')->nullable();
            $table->text('amenity_desc3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->dropColumn('amenity_icon1');
            $table->dropColumn('amenity_icon2');
            $table->dropColumn('amenity_icon3');
            $table->dropColumn('amenity_title1');
            $table->dropColumn('amenity_title2');
            $table->dropColumn('amenity_title3');
            $table->dropColumn('amenity_desc1');
            $table->dropColumn('amenity_desc2');
            $table->dropColumn('amenity_desc3');
        });
    }
};
