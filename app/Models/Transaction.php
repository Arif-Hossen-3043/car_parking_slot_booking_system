<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Booking;

class Transaction extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'transaction_id',
        'is_approved'
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation to Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
