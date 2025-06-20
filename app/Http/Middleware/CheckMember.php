<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Check if user has member role
        if ($user->user_type !== 'member' || !$user->member) {
            abort(403, 'Access denied. Member access required.');
        }

        return $next($request);
    }
}

// Don't forget to register this middleware in app/Http/Kernel.php:
// protected $routeMiddleware = [
//     // ... other middlewares
//     'check.member' => \App\Http\Middleware\CheckMember::class,
// ];