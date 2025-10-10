<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable (Mass Assignment Protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    /**
     * Get the properties that have this amenity.
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_amenities')->withTimestamps();
    }
}
