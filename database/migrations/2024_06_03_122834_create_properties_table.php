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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->string('slug');
            $table->double('price', 20, 2);
            $table->unsignedBigInteger('neighborhood_id');
            $table->tinyInteger('listing_status')->comment('1: For Sale, 2: For Rent, 3: Rented, 4: Sale Pending, 5: Sold');
            $table->string('size');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('parking_spaces');
            $table->string('banner');
            $table->text('gallery');
            $table->string('map')->nullable();
            $table->mediumText('description');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->tinyInteger('dev_lvl')->comment('1: Under Construction, 2: Built, 3: Under Renovation, 4: Renovated');
            $table->string('year_built');
            $table->string('property_tax');
            $table->string('hoa_fees');
            $table->tinyInteger('rent_cycle')->comment('1: Monthly, 2: Quarterly, 3: Semi-Annually, 4: Annually');
            $table->dateTime('date_available');
            $table->tinyInteger('status')->default(1)->comment('0: Inactive, 1: Active');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
