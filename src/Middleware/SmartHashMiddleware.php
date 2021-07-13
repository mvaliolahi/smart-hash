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
            // Decode id
            if ($request->filled('id')) {
                $request->merge([
                    'id' => (new Hashids())->decode($request->id)[0],
                ]);
            }

            // Decode Ids array
            if ($request->filled('ids')) {

                $ids = collect($request->ids)->transform(function ($id) {
                    return (new Hashids())->decode($id)[0];
                });

                $request->merge([
                    'ids' => $ids->toArray(),
                ]);
            }

        } catch (Throwable $exception) {
            throw new Exception('Hash id is not valid.');
        }

        return $next($request);
    }
}
