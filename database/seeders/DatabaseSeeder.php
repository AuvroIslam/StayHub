<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with basic sample data.
     * 
     * Note: This seeder only uses the simplified schema (users, properties, bookings).
     * For comprehensive data, use: php artisan db:seed --class=AirbnbStyleSeeder
     */
    public function run(): void
    {
        // Create Users (Admin, Owners, and Customers)
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1-555-0100',
            'bio' => 'StayHub Administrator',
        ]);

        $owner1 = User::create([
            'name' => 'John Smith',
            'email' => 'john@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '+1-555-0101',
            'bio' => 'Experienced property owner with 5+ years in hospitality.',
        ]);

        $customer1 = User::create([
            'name' => 'Mike Davis',
            'email' => 'mike@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+1-555-0201',
            'bio' => 'Travel enthusiast and digital nomad.',
        ]);

        // Create sample properties
        $property1 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Modern Apartment in City Center',
            'description' => 'Beautiful modern apartment with stunning city views. Perfect for business travelers and couples.',
            'address' => '123 Main Street, Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'property_type' => 'apartment',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_guests' => 4,
            'price_per_night' => 120.00,
            'status' => 'active',
        ]);

        // Create sample booking
        Booking::create([
            'property_id' => $property1->id,
            'user_id' => $customer1->id,
            'check_in' => now()->addDays(5),
            'check_out' => now()->addDays(10),
            'guests' => 2,
            'total_price' => 600.00,
            'status' => 'confirmed',
        ]);

        $this->command->info('Basic database seeded successfully!');
        $this->command->info('Test Accounts:');
        $this->command->info('Admin: admin@stayhub.com / password');
        $this->command->info('Owner: john@stayhub.com / password');
        $this->command->info('Customer: mike@stayhub.com / password');
        $this->command->info('');
        $this->command->info('For comprehensive Airbnb-style data, run:');
        $this->command->info('php artisan db:seed --class=AirbnbStyleSeeder');
    }
}

