<?php
/**
 * Check if the user's account has been disabled
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    // User's account is inactive
    if(auth()->check() && (auth()->user()->active == false)){
            // Logout the user that tried to log in
            Auth::logout();
            // Make sure that the session becomes invalidated
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            // Redirect back to the login page with an error
            return redirect()->route('login')->with('error', 'Your Account is suspended, please contact Admin.');

    }

    return $next($request);
}
}
