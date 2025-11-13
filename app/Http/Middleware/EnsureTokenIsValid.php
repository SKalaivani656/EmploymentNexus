<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
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

        $collection = collect(['86508650286508658650865028650865s0239602396039602396002396023960396023960']);
        if (!$collection->contains($request->header('authorization'))) {
            return response('unauthorized user', 200)
                ->header('Content-Type', 'text/plain');
        }

        return $next($request);
    }
}
