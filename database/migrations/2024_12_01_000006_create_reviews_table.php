<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('rating'); // 1-5 stars
            $table->integer('cleanliness_rating')->nullable();
            $table->integer('communication_rating')->nullable();
            $table->integer('checkin_rating')->nullable();
            $table->integer('accuracy_rating')->nullable();
            $table->integer('location_rating')->nullable();
            $table->integer('value_rating')->nullable();
            $table->text('comment');
            $table->timestamps();
            
            $table->index(['property_id', 'rating']);
            $table->unique('booking_id'); // One review per booking
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
