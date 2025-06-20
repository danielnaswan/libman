<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberHomeController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;
        
        if (!$member) {
            return redirect()->route('login')->with('error', 'Member profile not found.');
        }

        // Get member's active reservations
        $myReservations = $member->reservations()
            ->with('book')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        // Get some statistics
        $totalReservations = $member->reservations()->count();
        $activeReservations = $member->reservations()->active()->count();

        return view('dashboard-member', compact('member', 'myReservations', 'totalReservations', 'activeReservations'));
    }
}