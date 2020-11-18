<?php

namespace App\Http\Middleware;

use App\Models\AccessCode;
use App\Repositories\AccessCode\AccessCodeRepositoryInterface;
use Closure;

class AccessCodeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accessCode = AccessCode::first();
        if (!\Cookie::get('isCheckedAccessCode') && $accessCode->is_valid && empty(auth()->user()->admin_flg)) {
            return redirect('/access-code');
        }

        return $next($request);
    }
}
