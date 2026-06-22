<?php

namespace App\Http\Middleware;
use Closure;

class CheckInternetConnection
{
    public function handle($request, Closure $next)
    {
        $connected = @fsockopen("google.com", 80);

        if (!$connected) { 
          //  return response('No internet connection');
            return response()->json([
                //'error' => 'No internet connection'
                 'error' => ['id'=>1, 'msg' => ['id'=>0,'msg' => 'No internet connection!']]
            ], 503);
        }

        return $next($request);
    }
}
 