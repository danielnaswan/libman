<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
        
        // Check if user has admin role
        if ($user->user_type !== 'admin' || !$user->admin) {
            abort(403, 'Access denied. Admin access required.');
        }

        return $next($request);
    }
}

// Don't forget to register this middleware in app/Http/Kernel.php:
// protected $routeMiddleware = [
//     // ... other middlewares
//     'check.admin' => \App\Http\Middleware\CheckAdmin::class,
//     'check.member' => \App\Http\Middleware\CheckMember::class,
// ];