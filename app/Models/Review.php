<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable (Mass Assignment Protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'property_id',
        'user_id',
        'booking_id',
        'rating',
        'cleanliness_rating',
        'communication_rating',
        'checkin_rating',
        'accuracy_rating',
        'location_rating',
        'value_rating',
        'comment',
    ];

    /**
     * Get the property for this review.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the user who wrote this review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking associated with this review.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the average of all rating categories.
     */
    public function getAverageDetailedRatingAttribute()
    {
        $ratings = [
            $this->cleanliness_rating,
            $this->communication_rating,
            $this->checkin_rating,
            $this->accuracy_rating,
            $this->location_rating,
            $this->value_rating,
        ];

        $ratings = array_filter($ratings); // Remove nulls
        
        return count($ratings) > 0 ? round(array_sum($ratings) / count($ratings), 1) : null;
    }
}
