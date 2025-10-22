<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class AddMoreImagesSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Collection of high-quality Unsplash images for different room types
        $imageUrls = [
            // Living rooms
            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800',
            'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800',
            'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=800',
            'https://images.unsplash.com/photo-1571055107559-3e67626fa8be?w=800',
            'https://images.unsplash.com/photo-1574691250077-03a929faece5?w=800',
            
            // Bedrooms
            'https://images.unsplash.com/photo-1505693314120-0d443867891c?w=800',
            'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=800',
            'https://images.unsplash.com/photo-1586105251261-72a756497a11?w=800',
            'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800',
            'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800',
            
            // Kitchens
            'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800',
            'https://images.unsplash.com/photo-1600489000022-c2086d79f9d4?w=800',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800',
            'https://images.unsplash.com/photo-1595814432152-bb64fc1d0bf8?w=800',
            'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?w=800',
            
            // Bathrooms
            'https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800',
            'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800',
            'https://images.unsplash.com/photo-1563298723-dcfebaa392e3?w=800',
            'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
            'https://images.unsplash.com/photo-1604709177225-055f99402ea3?w=800',
            
            // Dining areas
            'https://images.unsplash.com/photo-1577140917170-285929fb55b7?w=800',
            'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?w=800',
            'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800',
            'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=800',
            'https://images.unsplash.com/photo-1565182999561-18d7dc61c393?w=800',
        ];

        // Get all properties
        $properties = Property::all();

        foreach ($properties as $property) {
            // Shuffle the images to get random selection
            $shuffledImages = collect($imageUrls)->shuffle();
            
            // Update property with 5 different images
            $property->update([
                'image' => $property->image ?: $shuffledImages[0], // Keep existing or set new
                'image_2' => $shuffledImages[1],
                'image_3' => $shuffledImages[2],
                'image_4' => $shuffledImages[3],
                'image_5' => $shuffledImages[4],
            ]);
        }

        $this->command->info('Successfully added multiple images to all properties!');
    }
}
