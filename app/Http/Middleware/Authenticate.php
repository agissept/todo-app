<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        $adminStatus = User::query()
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->where('user_id', auth()->id())
            ->where('admin', true)
            ->exists();
        UserRole::setAdminStatus($adminStatus);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
