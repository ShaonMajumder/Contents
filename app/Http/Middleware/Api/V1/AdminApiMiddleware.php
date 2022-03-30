<?php

namespace App\Http\Middleware\Api\V1;

use App\Http\Components\Message;
use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminApiMiddleware
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
        if(request()->user()->account_type == Account::where('name','admin')->first()->id)
            return $next($request);
        else
            return $this->apiOutput(Response::HTTP_UNAUTHORIZED , 'Only admin is allowed ...');
    }
}
