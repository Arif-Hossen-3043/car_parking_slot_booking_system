<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
      use HasFactory;

    protected $fillable = ['slot_number','vehicle_type', 'is_booked'];
}
