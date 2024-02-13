<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    #[NoReturn] public function handle($request, Closure $next)
    {
        $expiryDate = Carbon::parse(config('env.APP_EXPIRY_DATE'));

        if (Carbon::now()->gt($expiryDate)) {
            return redirect()->route('app-expired');
        }

        return $next($request);
    }
}
