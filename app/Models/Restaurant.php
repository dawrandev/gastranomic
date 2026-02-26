<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',
        'city_id',
        'branch_name',
        'phone',
        'description',
        'address',
        'location',
        'is_active',
        'qr_code'
    ];

    protected $appends = ['latitude', 'longitude']; // Avtomatik qo'shish uchun

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Cache coordinates to avoid multiple queries
    private $coordinates = null;

    /**
     * Get coordinates from location geometry
     */
    private function getCoordinates()
    {
        if ($this->coordinates === null) {
            if ($this->location) {
                // Use the actual location value from the model
                $result = DB::selectOne(
                    "SELECT ST_X(?) as longitude, ST_Y(?) as latitude",
                    [$this->location, $this->location]
                );

                $this->coordinates = [
                    'latitude' => $result ? (float) $result->latitude : null,
                    'longitude' => $result ? (float) $result->longitude : null,
                ];
            } else {
                $this->coordinates = [
                    'latitude' => null,
                    'longitude' => null,
                ];
            }
        }

        return $this->coordinates;
    }

    public function getLatitudeAttribute()
    {
        return $this->getCoordinates()['latitude'];
    }

    public function getLongitudeAttribute()
    {
        return $this->getCoordinates()['longitude'];
    }

    // Relations
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function operatingHours()
    {
        return $this->hasMany(OperatingHour::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'restaurant_category');
    }

    public function images()
    {
        return $this->hasMany(RestaurantImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(RestaurantImage::class)->where('is_cover', true);
    }

    public function menuItems()
    {
        return $this->hasManyThrough(MenuItem::class, RestaurantMenuItem::class, 'restaurant_id', 'id', 'id', 'menu_item_id');
    }

    public function restaurantMenuItems()
    {
        return $this->hasMany(RestaurantMenuItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getNameAttribute()
    {
        return $this->brand?->title ?? $this->branch_name;
    }
}
