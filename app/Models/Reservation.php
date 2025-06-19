<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'reserved_until',
    ];

    protected $casts = [
        'reserved_until' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Helper method to check if reservation is expired
    public function isExpired()
    {
        return $this->reserved_until < now()->toDateString();
    }

    // Scope for active reservations
    public function scopeActive($query)
    {
        return $query->where('reserved_until', '>=', now()->toDateString());
    }

    // Scope for expired reservations
    public function scopeExpired($query)
    {
        return $query->where('reserved_until', '<', now()->toDateString());
    }
}