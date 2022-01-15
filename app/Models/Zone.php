<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'region', 'country'
    ];

     /**
     * Get the Representative that work at the zone.
     */
    public function representative()
    {
        return $this->belongsTo(User::class);
    }
}
