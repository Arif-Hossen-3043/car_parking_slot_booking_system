<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slot_number',
        'car_number',
        'driver_license',
        'start_time',
        'hours',
        'is_paid',
        'payment_method',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation to Transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
