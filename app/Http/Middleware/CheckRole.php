<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        switch ($roles) {
            case 'admin':
                // Allow role_id=1 to manage all users
                if (auth()->user()->role_id != 1) {
                    abort(403);
                }
                break;
            case 'employer':
                if (auth()->user()->role_id != 2) {
                    abort(403);
                }
                break;
            case 'business':
                if (auth()->user()->role_id != 3) {
                    abort(403);
                }
                break;
            case 'dealer':
                if (auth()->user()->role_id != 4) {
                    abort(403);
                }
                break;
            case 'agent':
                if (auth()->user()->role_id != 5) {
                    abort(403);
                }
                break;
            case 'employee':
                // Allow role_id=6 to manage all users except role_id=1
                if (auth()->user()->role_id != 6 && auth()->user()->role_id != 1) {
                    abort(403);
                }
                break;
            default:
                abort(403);
                break;
        }

        return $next($request);
    }
}
