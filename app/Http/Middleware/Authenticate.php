<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // اگر مسیر شامل کلمه freelancer است
        if ($request->is('freelancer/*')) {
            return url('/elta/login?role=freelancer');
        }

        // اگر مسیر شامل employer است
        if ($request->is('employer/*')) {
            return url('/elta/login?role=employer');
        }

        // مسیر پیش‌فرض
        return url('/elta/login');
    }

}
