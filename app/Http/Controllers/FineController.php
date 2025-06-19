<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Member;
use App\Models\Reservation;
use Illuminate\Http\Request;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fines = Fine::with(['member', 'reservation.book'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get summary statistics
        $totalFines = Fine::sum('amount');
        $overdueFines = Fine::overdue()->sum('amount');
        $activeFines = Fine::active()->count();
        $overdueCount = Fine::overdue()->count();

        return view('pages.admin.fine.fine-index', compact(
            'fines', 
            'totalFines', 
            'overdueFines', 
            'activeFines', 
            'overdueCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        $reservations = Reservation::with(['member', 'book'])->get();
        
        return view('pages.admin.fine.fine-create', compact('members', 'reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'reserve_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0.01|max:9999.99',
            'due_date' => 'required|date|after:today',
        ]);

        Fine::create($request->all());

        return redirect()->route('fines.index')
            ->with('success', 'Fine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fine $fine)
    {
        $fine->load(['member', 'reservation.book']);
        
        return view('pages.admin.fine.fine-show', compact('fine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fine $fine)
    {
        $members = Member::all();
        $reservations = Reservation::with(['member', 'book'])->get();
        
        return view('pages.admin.fine.fine-edit', compact('fine', 'members', 'reservations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fine $fine)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'reserve_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0.01|max:9999.99',
            'due_date' => 'required|date|after:today',
        ]);

        $fine->update($request->all());

        return redirect()->route('fines.index')
            ->with('success', 'Fine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();

        return redirect()->route('fines.index')
            ->with('success', 'Fine deleted successfully.');
    }

    /**
     * Display overdue fines
     */
    public function overdue()
    {
        $fines = Fine::overdue()
            ->with(['member', 'reservation.book'])
            ->orderBy('due_date', 'asc')
            ->paginate(10);

        return view('pages.admin.fine.fine-overdue', compact('fines'));
    }

    /**
     * Display fines due soon
     */
    public function dueSoon()
    {
        $fines = Fine::dueSoon()
            ->with(['member', 'reservation.book'])
            ->orderBy('due_date', 'asc')
            ->paginate(10);

        return view('pages.admin.fine.fine-duesoon', compact('fines'));
    }
}