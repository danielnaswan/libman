<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('user')->latest()->simplePaginate(15);
        return view('pages.admin.member.member-index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get users who are not already members
        $availableUsers = User::whereNotIn('id', Member::pluck('user_id'))->get();
        $statuses = Member::getStatuses();
        
        return view('pages.admin.member.member-create', compact('availableUsers', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:members,user_id',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $member->load('user', 'reservations', 'fines');
        return view('pages.admin.member.member-show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $statuses = Member::getStatuses();
        return view('pages.admin.member.member-edit', compact('member', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $member->update($request->only('status'));

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully.');
    }
}