<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            ['name' => 'WiFi', 'icon' => 'fa-wifi', 'description' => 'High-speed internet connection'],
            ['name' => 'Kitchen', 'icon' => 'fa-utensils', 'description' => 'Fully equipped kitchen'],
            ['name' => 'Washer', 'icon' => 'fa-soap', 'description' => 'Washing machine'],
            ['name' => 'Dryer', 'icon' => 'fa-wind', 'description' => 'Clothes dryer'],
            ['name' => 'Air Conditioning', 'icon' => 'fa-snowflake', 'description' => 'Central AC'],
            ['name' => 'Heating', 'icon' => 'fa-fire', 'description' => 'Central heating'],
            ['name' => 'TV', 'icon' => 'fa-tv', 'description' => 'Television with cable'],
            ['name' => 'Free Parking', 'icon' => 'fa-parking', 'description' => 'On-premises parking'],
            ['name' => 'Pool', 'icon' => 'fa-swimming-pool', 'description' => 'Swimming pool'],
            ['name' => 'Gym', 'icon' => 'fa-dumbbell', 'description' => 'Fitness center'],
            ['name' => 'Elevator', 'icon' => 'fa-elevator', 'description' => 'Building elevator'],
            ['name' => 'Pet Friendly', 'icon' => 'fa-dog', 'description' => 'Pets allowed'],
            ['name' => 'Workspace', 'icon' => 'fa-laptop', 'description' => 'Dedicated workspace'],
            ['name' => 'Smoke Alarm', 'icon' => 'fa-bell', 'description' => 'Safety smoke detector'],
            ['name' => 'Fire Extinguisher', 'icon' => 'fa-fire-extinguisher', 'description' => 'Safety equipment'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
