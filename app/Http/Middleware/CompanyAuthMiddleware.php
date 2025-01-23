<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Traits\Helpers\TokenParser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyAuthMiddleware
{
    use TokenParser;
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $this->parseToken($request);

        if (!$token || !Company::where('remember_token', $token)->exists()) {
            return response()->json(
                [
                    'code'=>403,
                    'message' => 'Action is forbidden'
                ],
                403);
        }
        return $next($request);
    }
}
