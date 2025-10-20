<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class SimplifiedDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Owner Users
        $owner1 = User::create([
            'name' => 'John Owner',
            'email' => 'john@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'email_verified_at' => now(),
        ]);

        $owner2 = User::create([
            'name' => 'Sarah Owner',
            'email' => 'sarah@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'email_verified_at' => now(),
        ]);

        // Create Customer Users
        $customer1 = User::create([
            'name' => 'Mike Customer',
            'email' => 'mike@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $customer2 = User::create([
            'name' => 'Emma Customer',
            'email' => 'emma@stayhub.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        // Create Properties
        $property1 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Luxury Beachfront Villa',
            'description' => 'Beautiful villa with stunning ocean views, perfect for families.',
            'address' => '123 Ocean Drive',
            'city' => 'Miami',
            'state' => 'FL',
            'zip_code' => '33139',
            'property_type' => 'villa',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'max_guests' => 8,
            'price_per_night' => 350.00,
            'status' => 'active',
        ]);

        $property2 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Cozy Downtown Apartment',
            'description' => 'Modern apartment in the heart of the city with great amenities.',
            'address' => '456 Main Street',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'property_type' => 'apartment',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'max_guests' => 4,
            'price_per_night' => 150.00,
            'status' => 'active',
        ]);

        $property3 = Property::create([
            'user_id' => $owner2->id,
            'title' => 'Mountain Retreat House',
            'description' => 'Peaceful mountain house with incredible views and hiking trails.',
            'address' => '789 Mountain Road',
            'city' => 'Denver',
            'state' => 'CO',
            'zip_code' => '80202',
            'property_type' => 'house',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'max_guests' => 6,
            'price_per_night' => 200.00,
            'status' => 'active',
        ]);

        $property4 = Property::create([
            'user_id' => $owner2->id,
            'title' => 'Urban Studio Loft',
            'description' => 'Stylish studio perfect for solo travelers or couples.',
            'address' => '321 Art District',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'zip_code' => '90013',
            'property_type' => 'condo',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'max_guests' => 2,
            'price_per_night' => 120.00,
            'status' => 'active',
        ]);

        // Create Bookings
        Booking::create([
            'property_id' => $property1->id,
            'user_id' => $customer1->id,
            'check_in' => now()->addDays(10),
            'check_out' => now()->addDays(15),
            'guests' => 4,
            'total_price' => 1750.00, // 5 nights * $350
            'status' => 'pending',
        ]);

        Booking::create([
            'property_id' => $property2->id,
            'user_id' => $customer2->id,
            'check_in' => now()->addDays(5),
            'check_out' => now()->addDays(8),
            'guests' => 2,
            'total_price' => 450.00, // 3 nights * $150
            'status' => 'confirmed',
        ]);

        Booking::create([
            'property_id' => $property3->id,
            'user_id' => $customer1->id,
            'check_in' => now()->subDays(5),
            'check_out' => now()->subDays(2),
            'guests' => 6,
            'total_price' => 600.00, // 3 nights * $200
            'status' => 'completed',
        ]);

        Booking::create([
            'property_id' => $property4->id,
            'user_id' => $customer2->id,
            'check_in' => now()->addDays(20),
            'check_out' => now()->addDays(25),
            'guests' => 2,
            'total_price' => 600.00, // 5 nights * $120
            'status' => 'pending',
        ]);

        $this->command->info('✅ Simplified database seeded successfully!');
        $this->command->info('');
        $this->command->info('📧 Test Accounts:');
        $this->command->info('  Admin: admin@stayhub.com / password');
        $this->command->info('  Owner 1: john@stayhub.com / password');
        $this->command->info('  Owner 2: sarah@stayhub.com / password');
        $this->command->info('  Customer 1: mike@stayhub.com / password');
        $this->command->info('  Customer 2: emma@stayhub.com / password');
    }
}
