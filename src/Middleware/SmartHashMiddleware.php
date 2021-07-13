<?php

namespace Mvaliolahi\SmartHash\Middleware;

use Closure;
use Exception;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Throwable;

class SmartHashMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        try {
            // Decode single parameters.
            collect(config('smart-hash.single_parameters'))->each(function ($parameter) use ($request) {
                if ($request->filled($parameter)) {
                    $request->merge([
                        $parameter => (new Hashids())->decode($request->$parameter)[0],
                    ]);
                }
            });

            // Decode array parameters
            collect(config('smart-hash.array_parameters'))->each(function ($parameter) use ($request) {
                if ($request->filled($parameter)) {

                    $decoded = collect($request->$parameter)->transform(function ($p) {
                        return (new Hashids())->decode($p)[0];
                    });

                    $request->merge([
                        $parameter => $decoded->toArray(),
                    ]);
                }
            });
        } catch (Throwable $exception) {
            throw new Exception("Hash id is not valid ({$exception->getMessage()})");
        }

        return $next($request);
    }
}
