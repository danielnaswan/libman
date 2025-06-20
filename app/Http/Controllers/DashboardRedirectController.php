<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function redirect()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Redirect based on user type
        if ($user->user_type === 'admin' && $user->admin) {
            return redirect()->route('admin.dashboard'); // Admin dashboard
        } elseif ($user->user_type === 'member' && $user->member) {
            return redirect()->route('member.dashboard'); // Member dashboard
        }

        // If user doesn't have proper role setup, logout
        Auth::logout();
        return redirect()->route('login')->with('error', 'Your account is not properly configured. Please contact the administrator.');
    }
}