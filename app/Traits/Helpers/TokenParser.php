<?php

namespace App\Traits\Helpers;

use Illuminate\Http\Request;

trait TokenParser
{
    protected function parseToken(Request $request): array|string|null
    {
        $token = $request->header('Authorization');
        return str_replace('Bearer ', '', $token);
    }
}
