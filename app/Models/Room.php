<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    //type + last digit of location, i.e. Study Room at 10.2.2 becomes "Study Room 2"
    public function getRoomName() {
        return $this->type . ' ' . explode('.', $this->location)[2];
    }
}
