<?php

namespace App\Http\Middleware;

use App\Services\TransactionService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MembershipMiddleware
{

    public function __construct(private TransactionService $transactionService) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->transactionService->hasMembership()) {
            return $next($request);
        }

        return redirect()->route('pricing');
    }
}
