<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'longitude',
        'latitude',
        'phone',
        'is_active',
        'qr_code'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
