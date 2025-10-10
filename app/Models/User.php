<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'profile_image',
    ];
    
    /**
     * Get the properties owned by the user (for owners).
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    
    /**
     * Get the bookings made by the user (for customers).
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    /**
     * Get the reviews written by the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    
    /**
     * Get the user's favorite properties.
     */
    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites')->withTimestamps();
    }
    
    /**
     * Check if user is an owner.
     */
    public function isOwner()
    {
        return $this->role === 'owner';
    }
    
    /**
     * Check if user is a customer.
     */
    public function isCustomer()
    {
        return $this->role === 'customer';
    }
    
    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
