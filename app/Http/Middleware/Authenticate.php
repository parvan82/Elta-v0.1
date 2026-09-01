<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * مسیر ریدایرکت زمانی که کاربر احراز هویت نشده
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // ۱️⃣ اگر مسیر کارت است یا هر مسیر دلخواه، role از query بگیر
        $role = $request->query('role', null);

        if ($role) {
            return url("/elta/login?role={$role}");
        }

        // ۲️⃣ مسیرهای استاندارد employer / freelancer
        if ($request->is('freelancer/*')) {
            return url('/elta/login?role=freelancer');
        }

        if ($request->is('employer/*')) {
            return url('/elta/login?role=employer');
        }

        // مسیر پیش‌فرض
        return url('/elta/login');
    }
}

