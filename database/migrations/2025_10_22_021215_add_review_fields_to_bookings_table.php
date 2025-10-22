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
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('rating')->nullable(); // Overall rating 1-5
            $table->integer('cleanliness_rating')->nullable();
            $table->integer('communication_rating')->nullable();
            $table->integer('checkin_rating')->nullable();
            $table->integer('accuracy_rating')->nullable();
            $table->integer('location_rating')->nullable();
            $table->integer('value_rating')->nullable();
            $table->text('review_comment')->nullable();
            $table->timestamp('reviewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'rating',
                'cleanliness_rating', 
                'communication_rating',
                'checkin_rating',
                'accuracy_rating',
                'location_rating',
                'value_rating',
                'review_comment',
                'reviewed_at'
            ]);
        });
    }
};
