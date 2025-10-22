<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $phone
 * @property string|null $bio
 * @property string|null $profile_image
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Property> $properties
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Booking> $bookings
 * 
 * @method bool isOwner()
 * @method bool isCustomer()
 * @method bool isAdmin()
 * 
 * @mixin \Eloquent
 */
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
        'date_of_birth',
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
     * Check if user is an owner.
     * 
     * @return bool
     */
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }
    
    /**
     * Check if user is a customer.
     * 
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
    
    /**
     * Check if user is an admin.
     * 
     * @return bool
     */
    public function isAdmin(): bool
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
