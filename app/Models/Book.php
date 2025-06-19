<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author', // Added author field
        'publisher',
        'publication_year',
        'description',
        'isbn', // Added ISBN field
    ];

    protected $casts = [
        'publication_year' => 'integer', // Fixed typo: was $cast, should be $casts
    ];

    // Relationships
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Helper methods
    public function isReserved()
    {
        return $this->reservations()->where('reserved_until', '>=', now())->exists();
    }

    public function getCurrentReservation()
    {
        return $this->reservations()
            ->where('reserved_until', '>=', now())
            ->with('member.user')
            ->first();
    }

    public function getAvailabilityStatusAttribute()
    {
        return $this->isReserved() ? 'Reserved' : 'Available';
    }

    public function getAvailabilityBadgeClassAttribute()
    {
        return $this->isReserved() ? 'bg-gradient-warning' : 'bg-gradient-success';
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->whereDoesntHave('reservations', function ($q) {
            $q->where('reserved_until', '>=', now());
        });
    }

    public function scopeReserved($query)
    {
        return $query->whereHas('reservations', function ($q) {
            $q->where('reserved_until', '>=', now());
        });
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('publication_year', $year);
    }

    public function scopeSearchByTitle($query, $title)
    {
        return $query->where('title', 'like', "%{$title}%");
    }

    public function scopeSearchByAuthor($query, $author)
    {
        return $query->where('author', 'like', "%{$author}%");
    }
}