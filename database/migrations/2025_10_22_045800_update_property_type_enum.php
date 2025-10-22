<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the property_type enum to include more options
        DB::statement("ALTER TABLE properties MODIFY COLUMN property_type ENUM('apartment', 'house', 'villa', 'studio', 'condo', 'other') NOT NULL DEFAULT 'apartment'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values  
        DB::statement("ALTER TABLE properties MODIFY COLUMN property_type ENUM('apartment', 'house', 'villa', 'condo') NOT NULL DEFAULT 'apartment'");
    }
};
