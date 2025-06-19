<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'reserve_id',
        'amount',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserve_id');
    }

    // Helper method to check if fine is overdue
    public function isOverdue()
    {
        return $this->due_date < now()->toDateString();
    }

    // Helper method to get days until due or overdue
    public function getDaysUntilDue()
    {
        return now()->diffInDays($this->due_date, false);
    }

    // Helper method to format amount with currency
    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 2);
    }

    // Scope for overdue fines
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now()->toDateString());
    }

    // Scope for upcoming fines (due within X days)
    public function scopeDueSoon($query, $days = 7)
    {
        return $query->whereBetween('due_date', [
            now()->toDateString(),
            now()->addDays($days)->toDateString()
        ]);
    }

    // Scope for active fines (not overdue)
    public function scopeActive($query)
    {
        return $query->where('due_date', '>=', now()->toDateString());
    }
}