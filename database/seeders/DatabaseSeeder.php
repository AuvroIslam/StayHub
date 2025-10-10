<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Message;
use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with comprehensive sample data.
     */
    public function run(): void
    {
        // Create Amenities first
        $this->call(AmenitySeeder::class);
        $amenities = Amenity::all();

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
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '+1-555-0101',
            'bio' => 'Experienced property owner with 5+ years in hospitality.',
        ]);

        $owner2 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '+1-555-0102',
            'bio' => 'Luxury property specialist.',
        ]);

        $customer1 = User::create([
            'name' => 'Mike Davis',
            'email' => 'mike@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+1-555-0201',
            'bio' => 'Travel enthusiast and digital nomad.',
        ]);

        $customer2 = User::create([
            'name' => 'Emily Brown',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+1-555-0202',
            'bio' => 'Love exploring new places and cultures.',
        ]);

        $customer3 = User::create([
            'name' => 'David Wilson',
            'email' => 'david@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+1-555-0203',
            'bio' => 'Business traveler.',
        ]);

        // Create Properties
        $property1 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Modern Apartment in City Center',
            'description' => 'Beautiful modern apartment with stunning city views. Perfect for business travelers and couples. Located in the heart of downtown with easy access to restaurants, shopping, and entertainment.',
            'address' => '123 Main Street, Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'United States',
            'zip_code' => '10001',
            'type' => 'apartment',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_guests' => 4,
            'price_per_night' => 120.00,
            'cleaning_fee' => 30.00,
            'service_fee' => 15.00,
            'status' => 'active',
            'is_featured' => true,
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ]);

        $property2 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Cozy Studio Downtown',
            'description' => 'Charming studio apartment perfect for solo travelers. Fully equipped kitchen, comfortable bed, and great location near public transportation.',
            'address' => '456 Park Avenue',
            'city' => 'San Francisco',
            'state' => 'CA',
            'country' => 'United States',
            'zip_code' => '94102',
            'type' => 'studio',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'max_guests' => 2,
            'price_per_night' => 85.00,
            'cleaning_fee' => 25.00,
            'service_fee' => 10.00,
            'status' => 'active',
            'is_featured' => false,
            'latitude' => 37.7749,
            'longitude' => -122.4194,
        ]);

        $property3 = Property::create([
            'user_id' => $owner2->id,
            'title' => 'Luxury Beach Villa',
            'description' => 'Spectacular beachfront villa with private pool, direct beach access, and breathtaking ocean views. Perfect for families and groups looking for a luxurious getaway.',
            'address' => '789 Ocean Drive',
            'city' => 'Miami',
            'state' => 'FL',
            'country' => 'United States',
            'zip_code' => '33139',
            'type' => 'villa',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'max_guests' => 8,
            'price_per_night' => 350.00,
            'cleaning_fee' => 100.00,
            'service_fee' => 50.00,
            'status' => 'active',
            'is_featured' => true,
            'latitude' => 25.7617,
            'longitude' => -80.1918,
        ]);

        $property4 = Property::create([
            'user_id' => $owner2->id,
            'title' => 'Family House with Garden',
            'description' => 'Spacious family home with beautiful garden, perfect for kids. Quiet neighborhood, close to schools and parks.',
            'address' => '321 Elm Street',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'United States',
            'zip_code' => '90001',
            'type' => 'house',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'max_guests' => 6,
            'price_per_night' => 180.00,
            'cleaning_fee' => 50.00,
            'service_fee' => 25.00,
            'status' => 'active',
            'is_featured' => false,
            'latitude' => 34.0522,
            'longitude' => -118.2437,
        ]);

        $property5 = Property::create([
            'user_id' => $owner1->id,
            'title' => 'Mountain Cabin Retreat',
            'description' => 'Rustic cabin in the mountains. Perfect for nature lovers and those seeking peace and quiet. Fireplace, mountain views, and hiking trails nearby.',
            'address' => '555 Mountain Road',
            'city' => 'Aspen',
            'state' => 'CO',
            'country' => 'United States',
            'zip_code' => '81611',
            'type' => 'house',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'max_guests' => 5,
            'price_per_night' => 220.00,
            'cleaning_fee' => 60.00,
            'service_fee' => 30.00,
            'status' => 'active',
            'is_featured' => true,
            'latitude' => 39.1911,
            'longitude' => -106.8175,
        ]);

        $property6 = Property::create([
            'user_id' => $owner2->id,
            'title' => 'Penthouse Suite with City Views',
            'description' => 'Luxurious penthouse with panoramic city views. High-end amenities, modern design, and prime location.',
            'address' => '888 Michigan Avenue',
            'city' => 'Chicago',
            'state' => 'IL',
            'country' => 'United States',
            'zip_code' => '60611',
            'type' => 'apartment',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_guests' => 4,
            'price_per_night' => 280.00,
            'cleaning_fee' => 40.00,
            'service_fee' => 35.00,
            'status' => 'active',
            'is_featured' => false,
            'latitude' => 41.8781,
            'longitude' => -87.6298,
        ]);

        // Attach amenities to properties
        $property1->amenities()->attach([1, 2, 3, 4, 5, 6, 7, 8, 11, 13]); // WiFi, Kitchen, Washer, Dryer, AC, Heating, TV, Parking, Elevator, Workspace
        $property2->amenities()->attach([1, 2, 5, 6, 7, 13]); // WiFi, Kitchen, AC, Heating, TV, Workspace
        $property3->amenities()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12]); // Most amenities including Pool, Gym
        $property4->amenities()->attach([1, 2, 3, 4, 5, 6, 7, 8, 12, 13]); // WiFi, Kitchen, etc., Pet Friendly
        $property5->amenities()->attach([1, 2, 5, 6, 7, 8, 13]); // Basic amenities
        $property6->amenities()->attach([1, 2, 5, 6, 7, 8, 10, 11, 13]); // High-end amenities

        // Create Property Images (sample URLs)
        $imageUrls = [
            'https://images.unsplash.com/photo-1568605114967-8130f3a36994',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2',
            'https://images.unsplash.com/photo-1560185127-6ed189bf02f4',
            'https://images.unsplash.com/photo-1556909172-54557c7e4fb7',
            'https://images.unsplash.com/photo-1556909212-d5b604d0c90d',
        ];

        foreach ([$property1, $property2, $property3, $property4, $property5, $property6] as $index => $property) {
            foreach ($imageUrls as $order => $url) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $url . '?w=800',
                    'is_primary' => $order === 0,
                    'order' => $order,
                ]);
            }
        }

        // Create Bookings
        $booking1 = Booking::create([
            'property_id' => $property1->id,
            'user_id' => $customer1->id,
            'check_in' => now()->addDays(5),
            'check_out' => now()->addDays(10),
            'guests' => 2,
            'subtotal' => 600.00,
            'cleaning_fee' => 30.00,
            'service_fee' => 15.00,
            'total_price' => 645.00,
            'status' => 'confirmed',
            'special_requests' => 'Late check-in around 10 PM',
        ]);

        $booking2 = Booking::create([
            'property_id' => $property3->id,
            'user_id' => $customer2->id,
            'check_in' => now()->addDays(15),
            'check_out' => now()->addDays(22),
            'guests' => 6,
            'subtotal' => 2450.00,
            'cleaning_fee' => 100.00,
            'service_fee' => 50.00,
            'total_price' => 2600.00,
            'status' => 'confirmed',
        ]);

        $booking3 = Booking::create([
            'property_id' => $property2->id,
            'user_id' => $customer3->id,
            'check_in' => now()->subDays(10),
            'check_out' => now()->subDays(7),
            'guests' => 1,
            'subtotal' => 255.00,
            'cleaning_fee' => 25.00,
            'service_fee' => 10.00,
            'total_price' => 290.00,
            'status' => 'completed',
        ]);

        $booking4 = Booking::create([
            'property_id' => $property5->id,
            'user_id' => $customer1->id,
            'check_in' => now()->subDays(30),
            'check_out' => now()->subDays(27),
            'guests' => 4,
            'subtotal' => 660.00,
            'cleaning_fee' => 60.00,
            'service_fee' => 30.00,
            'total_price' => 750.00,
            'status' => 'completed',
        ]);

        $booking5 = Booking::create([
            'property_id' => $property4->id,
            'user_id' => $customer2->id,
            'check_in' => now()->addDays(2),
            'check_out' => now()->addDays(4),
            'guests' => 4,
            'subtotal' => 360.00,
            'cleaning_fee' => 50.00,
            'service_fee' => 25.00,
            'total_price' => 435.00,
            'status' => 'pending',
        ]);

        // Create Payments
        Payment::create([
            'booking_id' => $booking1->id,
            'amount' => 645.00,
            'payment_method' => 'credit_card',
            'status' => 'completed',
            'transaction_id' => 'TXN-' . uniqid(),
            'paid_at' => now(),
        ]);

        Payment::create([
            'booking_id' => $booking2->id,
            'amount' => 2600.00,
            'payment_method' => 'credit_card',
            'status' => 'completed',
            'transaction_id' => 'TXN-' . uniqid(),
            'paid_at' => now(),
        ]);

        Payment::create([
            'booking_id' => $booking3->id,
            'amount' => 290.00,
            'payment_method' => 'debit_card',
            'status' => 'completed',
            'transaction_id' => 'TXN-' . uniqid(),
            'paid_at' => now()->subDays(10),
        ]);

        Payment::create([
            'booking_id' => $booking4->id,
            'amount' => 750.00,
            'payment_method' => 'credit_card',
            'status' => 'completed',
            'transaction_id' => 'TXN-' . uniqid(),
            'paid_at' => now()->subDays(30),
        ]);

        // Create Reviews for completed bookings
        Review::create([
            'property_id' => $property2->id,
            'user_id' => $customer3->id,
            'booking_id' => $booking3->id,
            'rating' => 5,
            'cleanliness_rating' => 5,
            'communication_rating' => 5,
            'checkin_rating' => 5,
            'accuracy_rating' => 5,
            'location_rating' => 5,
            'value_rating' => 4,
            'comment' => 'Amazing apartment! Everything was exactly as described. John was a great host and very responsive. Would definitely stay here again!',
        ]);

        Review::create([
            'property_id' => $property5->id,
            'user_id' => $customer1->id,
            'booking_id' => $booking4->id,
            'rating' => 5,
            'cleanliness_rating' => 5,
            'communication_rating' => 5,
            'checkin_rating' => 5,
            'accuracy_rating' => 5,
            'location_rating' => 5,
            'value_rating' => 5,
            'comment' => 'Perfect mountain getaway! The cabin was cozy, clean, and the views were breathtaking. Highly recommend for nature lovers.',
        ]);

        Review::create([
            'property_id' => $property1->id,
            'user_id' => $customer2->id,
            'booking_id' => null, // Independent review
            'rating' => 4,
            'cleanliness_rating' => 5,
            'communication_rating' => 4,
            'checkin_rating' => 4,
            'accuracy_rating' => 5,
            'location_rating' => 5,
            'value_rating' => 4,
            'comment' => 'Great location and very clean. Only minor issue was some street noise, but overall excellent stay.',
        ]);

        // Create Messages
        Message::create([
            'sender_id' => $customer1->id,
            'receiver_id' => $owner1->id,
            'property_id' => $property1->id,
            'message' => 'Hi! Is the property available for the dates I selected?',
            'is_read' => true,
        ]);

        Message::create([
            'sender_id' => $owner1->id,
            'receiver_id' => $customer1->id,
            'property_id' => $property1->id,
            'message' => 'Yes, it is available! Feel free to book.',
            'is_read' => true,
        ]);

        Message::create([
            'sender_id' => $customer2->id,
            'receiver_id' => $owner2->id,
            'property_id' => $property3->id,
            'message' => 'Can we do early check-in?',
            'is_read' => false,
        ]);

        // Create Favorites
        Favorite::create([
            'user_id' => $customer1->id,
            'property_id' => $property3->id,
        ]);

        Favorite::create([
            'user_id' => $customer1->id,
            'property_id' => $property6->id,
        ]);

        Favorite::create([
            'user_id' => $customer2->id,
            'property_id' => $property1->id,
        ]);

        Favorite::create([
            'user_id' => $customer2->id,
            'property_id' => $property5->id,
        ]);

        Favorite::create([
            'user_id' => $customer3->id,
            'property_id' => $property4->id,
        ]);

        $this->command->info('Database seeded successfully with comprehensive sample data!');
        $this->command->info('Test Accounts:');
        $this->command->info('Admin: admin@stayhub.com / password');
        $this->command->info('Owner: john@example.com / password');
        $this->command->info('Customer: mike@example.com / password');
    }
}

