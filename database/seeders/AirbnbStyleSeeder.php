<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class AirbnbStyleSeeder extends Seeder
{
    // Real property data inspired by Airbnb listings
    private $propertyData = [
        [
            'title' => 'Stunning Ocean View Villa with Private Pool',
            'description' => 'Wake up to breathtaking ocean views in this luxury villa. Features include a private infinity pool, outdoor kitchen, and direct beach access. Perfect for families or groups seeking a memorable coastal getaway. The spacious living areas and modern amenities ensure a comfortable stay.',
            'type' => 'villa',
            'city' => 'Malibu',
            'state' => 'CA',
            'address' => '27456 Pacific Coast Highway',
            'zip' => '90265',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'guests' => 10,
            'price' => 850,
            'image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800'
        ],
        [
            'title' => 'Modern Downtown Loft - Walk to Everything',
            'description' => 'Stylish industrial loft in the heart of downtown. Exposed brick walls, high ceilings, and floor-to-ceiling windows provide a unique urban living experience. Walk to restaurants, shops, museums, and nightlife. Ideal for professionals or couples.',
            'type' => 'apartment',
            'city' => 'New York',
            'state' => 'NY',
            'address' => '125 Broadway',
            'zip' => '10007',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'guests' => 4,
            'price' => 275,
            'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800'
        ],
        [
            'title' => 'Cozy Mountain Cabin with Hot Tub',
            'description' => 'Escape to this charming cabin nestled in the mountains. Enjoy stunning views, a private hot tub, and access to hiking trails. The wood-burning fireplace and rustic decor create a warm atmosphere. Perfect for a romantic retreat or small family vacation.',
            'type' => 'house',
            'city' => 'Aspen',
            'state' => 'CO',
            'address' => '789 Mountain Ridge Road',
            'zip' => '81611',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'guests' => 6,
            'price' => 425,
            'image' => 'https://images.unsplash.com/photo-1542718610-a1d656d1884c?w=800'
        ],
        [
            'title' => 'Beachfront Condo - Direct Ocean Access',
            'description' => 'Step right onto the sand from this beautiful beachfront condo. Watch dolphins from your private balcony while enjoying your morning coffee. Fully renovated with designer furnishings, gourmet kitchen, and resort-style amenities including pool and fitness center.',
            'type' => 'condo',
            'city' => 'Miami Beach',
            'state' => 'FL',
            'address' => '3801 Collins Avenue',
            'zip' => '33140',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'guests' => 4,
            'price' => 320,
            'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800'
        ],
        [
            'title' => 'Luxury Penthouse with Rooftop Terrace',
            'description' => 'Experience high-end living in this spectacular penthouse. Features 360-degree city views, private rooftop terrace with bar and lounge area, smart home technology, and premium finishes throughout. Building amenities include concierge, valet, gym, and spa.',
            'type' => 'apartment',
            'city' => 'San Francisco',
            'state' => 'CA',
            'address' => '555 Mission Street',
            'zip' => '94105',
            'bedrooms' => 3,
            'bathrooms' => 3,
            'guests' => 6,
            'price' => 650,
            'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800'
        ],
        [
            'title' => 'Historic Brownstone in Tree-Lined Neighborhood',
            'description' => 'Beautiful 19th-century brownstone meticulously restored with modern amenities while preserving original character. Features original hardwood floors, decorative fireplaces, and a private garden. Located in a quiet, family-friendly neighborhood with excellent restaurants.',
            'type' => 'house',
            'city' => 'Boston',
            'state' => 'MA',
            'address' => '142 Beacon Street',
            'zip' => '02116',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'guests' => 8,
            'price' => 475,
            'image' => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=800'
        ],
        [
            'title' => 'Desert Oasis with Pool and Mountain Views',
            'description' => 'Modern desert retreat with stunning mountain backdrop. Private saltwater pool, outdoor shower, fire pit, and spacious patio perfect for stargazing. Contemporary design with natural materials, chef\'s kitchen, and indoor-outdoor living spaces.',
            'type' => 'villa',
            'city' => 'Palm Springs',
            'state' => 'CA',
            'address' => '1250 E Vista Chino',
            'zip' => '92262',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'guests' => 8,
            'price' => 550,
            'image' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800'
        ],
        [
            'title' => 'Charming Victorian Home with Garden',
            'description' => 'Lovingly restored Victorian home in historic district. Original stained glass, vintage fixtures, and period details throughout. Beautiful garden with fruit trees and herb garden. Walking distance to cafes, boutiques, and public transit.',
            'type' => 'house',
            'city' => 'Portland',
            'state' => 'OR',
            'address' => '2345 NW Thurman Street',
            'zip' => '97210',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'guests' => 6,
            'price' => 295,
            'image' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800'
        ],
        [
            'title' => 'Lakefront Cottage with Private Dock',
            'description' => 'Peaceful lakefront retreat perfect for water enthusiasts. Private dock with kayaks and paddleboards included. Screened porch, fire pit, and open floor plan ideal for gathering. Wake up to stunning sunrise views over the water.',
            'type' => 'house',
            'city' => 'Lake Tahoe',
            'state' => 'CA',
            'address' => '890 Lakeshore Boulevard',
            'zip' => '96150',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'guests' => 6,
            'price' => 385,
            'image' => 'https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?w=800'
        ],
        [
            'title' => 'Minimalist Studio in Arts District',
            'description' => 'Sleek, modern studio in trendy arts district. Floor-to-ceiling windows, designer furnishings, and fully equipped kitchen. Walk to galleries, coffee shops, and vintage stores. Perfect for creative professionals or solo travelers.',
            'type' => 'apartment',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'address' => '725 S Santa Fe Avenue',
            'zip' => '90021',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'guests' => 2,
            'price' => 165,
            'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800'
        ],
        [
            'title' => 'Rustic Farmhouse on 5 Acres',
            'description' => 'Authentic farmhouse on private acreage with stunning pastoral views. Original barn, chicken coop, and vegetable garden. Modern kitchen and bathrooms while maintaining farmhouse charm. Perfect for families wanting to experience country living.',
            'type' => 'house',
            'city' => 'Austin',
            'state' => 'TX',
            'address' => '15600 Ranch Road 12',
            'zip' => '78737',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'guests' => 8,
            'price' => 340,
            'image' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=800'
        ],
        [
            'title' => 'Waterfront Apartment with Marina Views',
            'description' => 'Elegant waterfront living with panoramic marina views. Watch boats sail by from your private balcony. High-end finishes, chef\'s kitchen, and spa-like bathrooms. Building features pool, gym, and 24-hour concierge service.',
            'type' => 'apartment',
            'city' => 'Seattle',
            'state' => 'WA',
            'address' => '1000 1st Avenue',
            'zip' => '98104',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'guests' => 4,
            'price' => 285,
            'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800'
        ],
        [
            'title' => 'Ski-In Ski-Out Mountain Chalet',
            'description' => 'Ultimate ski vacation home with direct slope access. Vaulted ceilings, massive stone fireplace, and walls of windows showcasing mountain views. Hot tub on deck, game room, and gourmet kitchen. Ski equipment storage and boot warmers.',
            'type' => 'house',
            'city' => 'Park City',
            'state' => 'UT',
            'address' => '7600 Royal Street East',
            'zip' => '84060',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'guests' => 10,
            'price' => 775,
            'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800'
        ],
        [
            'title' => 'Contemporary Townhouse in Walkable Neighborhood',
            'description' => 'Brand new townhouse with modern design and smart home features. Open concept living, chef\'s kitchen with quartz counters, and private rooftop deck. Walk to restaurants, shops, and metro station. Garage parking included.',
            'type' => 'house',
            'city' => 'Washington',
            'state' => 'DC',
            'address' => '1450 Corcoran Street NW',
            'zip' => '20009',
            'bedrooms' => 3,
            'bathrooms' => 3,
            'guests' => 6,
            'price' => 395,
            'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800'
        ],
        [
            'title' => 'Tropical Paradise Villa with Infinity Pool',
            'description' => 'Stunning tropical villa surrounded by lush gardens. Infinity pool overlooking the ocean, outdoor entertainment area, and multiple terraces. Indoor-outdoor living with retractable walls. Daily housekeeping included.',
            'type' => 'villa',
            'city' => 'Honolulu',
            'state' => 'HI',
            'address' => '4999 Kahala Avenue',
            'zip' => '96816',
            'bedrooms' => 6,
            'bathrooms' => 5,
            'guests' => 12,
            'price' => 950,
            'image' => 'https://images.unsplash.com/photo-1602343168117-bb8ffe3e2e9f?w=800'
        ],
        [
            'title' => 'Renovated Loft in Historic Building',
            'description' => 'Industrial chic loft in converted factory building. Soaring 15-foot ceilings, original brick walls, and polished concrete floors. Open kitchen with commercial appliances. Rooftop access with city skyline views.',
            'type' => 'apartment',
            'city' => 'Chicago',
            'state' => 'IL',
            'address' => '950 W Huron Street',
            'zip' => '60642',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'guests' => 4,
            'price' => 245,
            'image' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800'
        ],
    ];

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

        // Create Property Owners
        $owners = [];
        $ownerNames = [
            ['John Smith', 'john@stayhub.com'],
            ['Sarah Johnson', 'sarah@stayhub.com'],
            ['Michael Chen', 'michael@stayhub.com'],
            ['Emily Rodriguez', 'emily@stayhub.com'],
            ['David Kim', 'david@stayhub.com'],
        ];

        foreach ($ownerNames as $ownerData) {
            $owners[] = User::create([
                'name' => $ownerData[0],
                'email' => $ownerData[1],
                'password' => Hash::make('password'),
                'role' => 'owner',
                'email_verified_at' => now(),
            ]);
        }

        // Create Customers
        $customers = [];
        $customerNames = [
            ['Alice Williams', 'alice@example.com'],
            ['Bob Anderson', 'bob@example.com'],
            ['Carol Martinez', 'carol@example.com'],
            ['Daniel Brown', 'daniel@example.com'],
            ['Eva Davis', 'eva@example.com'],
        ];

        foreach ($customerNames as $customerData) {
            $customers[] = User::create([
                'name' => $customerData[0],
                'email' => $customerData[1],
                'password' => Hash::make('password'),
                'role' => 'customer',
                'email_verified_at' => now(),
            ]);
        }

        // Create Properties with realistic data
        $properties = [];
        foreach ($this->propertyData as $index => $data) {
            $owner = $owners[$index % count($owners)];
            
            $property = Property::create([
                'user_id' => $owner->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip_code' => $data['zip'],
                'property_type' => $data['type'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'max_guests' => $data['guests'],
                'price_per_night' => $data['price'],
                'status' => 'active',
                'image' => $data['image'],
            ]);

            $properties[] = $property;
        }

        // Create realistic bookings
        $bookingStatuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        
        for ($i = 0; $i < 25; $i++) {
            $property = $properties[array_rand($properties)];
            $customer = $customers[array_rand($customers)];
            $checkIn = now()->addDays(rand(-30, 60));
            $checkOut = $checkIn->copy()->addDays(rand(2, 14));
            $nights = $checkIn->diffInDays($checkOut);
            
            // Determine status based on dates
            if ($checkIn->isPast() && $checkOut->isPast()) {
                $status = 'completed';
            } elseif ($checkIn->isPast() && $checkOut->isFuture()) {
                $status = 'confirmed';
            } else {
                $status = $bookingStatuses[array_rand($bookingStatuses)];
            }

            Booking::create([
                'property_id' => $property->id,
                'user_id' => $customer->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => rand(1, min($property->max_guests, 6)),
                'total_price' => $nights * $property->price_per_night,
                'status' => $status,
            ]);
        }

        $this->command->info('✅ Airbnb-style database seeded successfully!');
        $this->command->info('');
        $this->command->info('📊 Created:');
        $this->command->info("  • 1 Admin");
        $this->command->info("  • " . count($owners) . " Property Owners");
        $this->command->info("  • " . count($customers) . " Customers");
        $this->command->info("  • " . count($properties) . " Properties");
        $this->command->info("  • 25 Bookings");
        $this->command->info('');
        $this->command->info('📧 Test Accounts (password: password):');
        $this->command->info('  Admin: admin@stayhub.com');
        $this->command->info('  Owners: john@stayhub.com, sarah@stayhub.com, etc.');
        $this->command->info('  Customers: alice@example.com, bob@example.com, etc.');
    }
}
