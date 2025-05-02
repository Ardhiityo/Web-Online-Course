<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MembershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = Auth::user();

        $isMembership = $student->transactions()
            ->where('is_paid', true)
            ->where('ended_at', '>=', now())
            ->exists();

        if ($isMembership) {
            return $next($request);
        }

        return redirect()->route('pricing');
    }
}
