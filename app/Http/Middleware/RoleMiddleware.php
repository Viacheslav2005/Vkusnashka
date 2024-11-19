<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role, $restrictForRole = null)
    {
        $user = Auth::user();

        // Если доступ ограничен для указанной роли
        if ($restrictForRole && $user->role === $restrictForRole) {
            return redirect()->route('index')->withErrors(['access_denied' => 'Данное действие недоступно для администратора']);
        }

        // Проверка на требуемую роль для доступа
        if ($user->role === $role) {
            return $next($request);
        }

        return redirect()->route('index')->withErrors(['access_denied' => 'У вас нет доступа к этой странице']);
    }
}
