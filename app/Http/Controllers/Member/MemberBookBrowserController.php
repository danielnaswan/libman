<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberBookBrowserController extends Controller
{
    public function books(Request $request)
    {
        $query = Book::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by availability
        if ($request->filled('availability')) {
            if ($request->get('availability') === 'available') {
                $query->available();
            }
        }

        $books = $query->orderBy('title', 'asc')->paginate(12);

        return view('pages.member.books', compact('books'));
    }

    public function reserve(Book $book)
    {
        $member = Auth::user()->member;

        if (!$member) {
            return redirect()->back()->with('error', 'Member profile not found.');
        }

        if ($member->status !== 'active') {
            return redirect()->back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

        if ($book->isReserved()) {
            return redirect()->back()->with('error', 'This book is already reserved.');
        }

        // Check if member already has 3 active reservations (library limit)
        $activeReservations = $member->reservations()->active()->count();
        if ($activeReservations >= 3) {
            return redirect()->back()->with('error', 'You have reached the maximum limit of 3 active reservations.');
        }

        // Create reservation (14 days from now)
        Reservation::create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'reserved_until' => Carbon::now()->addDays(14),
        ]);

        return redirect()->back()->with('success', 'Book reserved successfully! You have 14 days to collect it.');
    }

    public function cancelReservation(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated member
        if ($reservation->member_id !== Auth::user()->member->id) {
            abort(403, 'Unauthorized access to reservation.');
        }

        // Only allow cancellation of active reservations
        if ($reservation->isExpired()) {
            return redirect()->back()->with('error', 'Cannot cancel an expired reservation.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }
}