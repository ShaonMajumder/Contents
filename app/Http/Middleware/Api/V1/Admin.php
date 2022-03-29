<?php

namespace App\Http\Middleware\Api\V1;

use App\Http\Components\Message;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Admin
{
    use Message;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(request()->user()->type == 'driver')
            return $next($request);
        else
            return $this->apiOutput(Response::HTTP_UNAUTHORIZED , 'only driver is allowed');
    }
}
