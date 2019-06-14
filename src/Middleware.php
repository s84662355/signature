<?php
namespace HttpSign;

use Closure;

class Middleware
{
    public function handle($request, Closure $next)
    {
         

        return $next($request);
    }
}