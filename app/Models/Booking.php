<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
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
        'check_in',
        'check_out',
        'guests',
        'total_price',
        'status',
        'rating',
        'cleanliness_rating',
        'communication_rating',
        'checkin_rating',
        'accuracy_rating',
        'location_rating',
        'value_rating',
        'review_comment',
        'reviewed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the property for this booking.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the customer who made this booking.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the number of nights for this booking.
     */
    public function getNightsAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if this booking has been reviewed.
     */
    public function hasReview()
    {
        return !is_null($this->rating);
    }

    /**
     * Scope a query to only include bookings with reviews.
     */
    public function scopeWithReviews($query)
    {
        return $query->whereNotNull('rating');
    }
}
