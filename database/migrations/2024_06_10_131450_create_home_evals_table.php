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
        Schema::create('home_evals', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('year_built')->nullable();
            $table->string('size')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('half_bathroom')->nullable();
            $table->tinyInteger('has_suite')->default(1)->comment('1: No, 2: Yes, 3: Potential');
            $table->tinyInteger('garage')->default(0)->comment('0: N/A, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5+');
            $table->tinyInteger('garage_type')->default(1)->comment('1: Attached, 2: Detached');
            $table->tinyInteger('basement_type')->default(1)->comment('1: None, 2: Full, 3: Partial, 4: Crawl, 5: Walkout');
            $table->tinyInteger('dev_lvl')->default(1)->comment('1: None, 2: 25%, 3: 50%, 4: 75%, 5: Complete');
            $table->tinyInteger('move_plan')->default(1)->comment('1: 1 Month, 2: 3 Month, 3: 6 Month, 4: 1 Year, 5: 2+ Years');
            $table->mediumText('notes')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: New, 2: Contacted, 3: Closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_evals');
    }
};
