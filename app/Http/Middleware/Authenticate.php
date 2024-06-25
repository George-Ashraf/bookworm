<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is('/author/home')) {
                return route('selection');
            }
            elseif(Request::is('/admin/home')) {
                return route('selection');
            }
            elseif(Request::is('/bookstore/home')) {
                return route('selection');
            }
            else {
                return route('selection');
            }
        }
    }
}
