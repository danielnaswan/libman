<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Reservation;
use App\Models\Fine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current statistics
        $stats = $this->getDashboardStats();
        
        // Get chart data
        $chartData = $this->getChartData();
        
        return view('dashboard', compact('stats', 'chartData'));
    }
    
    private function getDashboardStats()
    {
        $today = Carbon::today();
        $lastWeek = Carbon::today()->subWeek();
        $lastMonth = Carbon::today()->subMonth();
        
        // Today's reservations
        $todayReservations = Reservation::whereDate('created_at', $today)->count();
        $lastWeekReservations = Reservation::whereBetween('created_at', [$lastWeek, $today->copy()->subDay()])->count();
        $reservationGrowth = $lastWeekReservations > 0 ? 
            round((($todayReservations - $lastWeekReservations) / $lastWeekReservations) * 100) : 0;
        
        // Active members (members with status 'active')
        $activeMembers = Member::where('status', Member::STATUS_ACTIVE)->count();
        $totalMembers = Member::count();
        $lastMonthMembers = Member::where('created_at', '<=', $lastMonth)->count();
        $memberGrowth = $lastMonthMembers > 0 ? 
            round((($totalMembers - $lastMonthMembers) / $lastMonthMembers) * 100) : 0;
        
        // Total books
        $totalBooks = Book::count();
        $newBooksThisMonth = Book::whereDate('created_at', '>=', $lastMonth)->count();
        $bookGrowth = $totalBooks > 0 ? 
            round(($newBooksThisMonth / $totalBooks) * 100) : 0;
        
        // Fines collected (total amount)
        $totalFines = Fine::sum('amount');
        $thisMonthFines = Fine::whereDate('created_at', '>=', $lastMonth)->sum('amount');
        $fineGrowth = $totalFines > 0 ? 
            round((($thisMonthFines / $totalFines) * 100)) : 0;
        
        // Additional metrics
        $overdueReservations = Reservation::where('reserved_until', '<', $today)->count();
        $overdueFines = Fine::where('due_date', '<', $today)->count();
        $activeFines = Fine::where('due_date', '>=', $today)->count();
        
        return [
            'today_reservations' => $todayReservations,
            'reservation_growth' => $reservationGrowth,
            'active_members' => $activeMembers,
            'member_growth' => $memberGrowth,
            'total_books' => $totalBooks,
            'book_growth' => $bookGrowth,
            'total_fines' => $totalFines,
            'fine_growth' => $fineGrowth,
            'overdue_reservations' => $overdueReservations,
            'overdue_fines' => $overdueFines,
            'active_fines' => $activeFines,
        ];
    }
    
    private function getChartData()
    {
        $months = [];
        $reservationsData = [];
        $finesData = [];
        $membersData = [];
        $booksData = [];
        
        // Get data for last 9 months
        for ($i = 8; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            // Reservations per month
            $reservationsData[] = Reservation::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            // Fines collected per month
            $finesData[] = Fine::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
            
            // New members per month
            $membersData[] = Member::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            // New books per month
            $booksData[] = Book::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }
        
        return [
            'months' => $months,
            'reservations' => $reservationsData,
            'fines' => $finesData,
            'members' => $membersData,
            'books' => $booksData,
        ];
    }
}