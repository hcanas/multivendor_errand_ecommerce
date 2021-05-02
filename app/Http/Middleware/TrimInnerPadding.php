<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrimInnerPadding
{
    /**
     * Trim excessive whitespace between characters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = $request->all();

        foreach ($data AS $key => $value) {
            $data[$key] = preg_replace('/\s+/', ' ', $value);
        }

        $request->merge($data);

        return $next($request);
    }
}
