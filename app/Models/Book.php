<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title', 'isbn', 'author', 'category', 'pages', 'publication'];
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
