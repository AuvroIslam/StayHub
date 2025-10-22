<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable (Mass Assignment Protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'address',
        'city',
        'state',
        'zip_code',
        'property_type',
        'bedrooms',
        'bathrooms',
        'max_guests',
        'price_per_night',
        'image',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    /**
     * Get the owner of the property.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the bookings for the property.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Scope a query to only include active properties.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    /**
     * Get total earnings from this property.
     */
    public function totalEarnings()
    {
        return $this->bookings()
            ->whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');
    }

    /**
     * Get reviews for this property (bookings with ratings).
     */
    public function reviews()
    {
        return $this->bookings()->withReviews()->with('customer');
    }

    /**
     * Get average rating for this property.
     */
    public function getAverageRatingAttribute()
    {
        $reviews = $this->bookings()->withReviews();
        return $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
    }

    /**
     * Get total number of reviews.
     */
    public function getTotalReviewsAttribute()
    {
        return $this->bookings()->withReviews()->count();
    }

    /**
     * Get average ratings by category.
     */
    public function getReviewStatsAttribute()
    {
        $reviews = $this->bookings()->withReviews();
        
        if ($reviews->count() === 0) {
            return [
                'cleanliness' => 0,
                'communication' => 0,
                'checkin' => 0,
                'accuracy' => 0,
                'location' => 0,
                'value' => 0,
            ];
        }

        return [
            'cleanliness' => round($reviews->avg('cleanliness_rating'), 1),
            'communication' => round($reviews->avg('communication_rating'), 1),
            'checkin' => round($reviews->avg('checkin_rating'), 1),
            'accuracy' => round($reviews->avg('accuracy_rating'), 1),
            'location' => round($reviews->avg('location_rating'), 1),
            'value' => round($reviews->avg('value_rating'), 1),
        ];
    }

    /**
     * Get all property images as an array.
     */
    public function getAllImagesAttribute()
    {
        return array_filter([
            $this->image,
            $this->image_2,
            $this->image_3,
            $this->image_4,
            $this->image_5,
        ]);
    }

    /**
     * Get image by index (1-5).
     */
    public function getImageByIndex($index)
    {
        switch ($index) {
            case 1: return $this->image;
            case 2: return $this->image_2;
            case 3: return $this->image_3;
            case 4: return $this->image_4;
            case 5: return $this->image_5;
            default: return null;
        }
    }
}
