<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable (Mass Assignment Protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'property_id',
    ];

    /**
     * Get the user who favorited the property.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the property that was favorited.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
