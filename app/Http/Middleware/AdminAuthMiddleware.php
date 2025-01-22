<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token || !Admin::where('remember_token', $token)->exists()) {
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
