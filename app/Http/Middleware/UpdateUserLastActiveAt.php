<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class UpdateUserLastActiveAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
// يعني كل ما اليوزر يعمل حدث يحدث الوقت علي اساسه ي وده هيلبر موجود في اللارافيل
// انستانس اوف يوزر علشان اي موديل عامل اكستند لليوزر زي الادمن تتنفز عليه نفس الفانكشن
        if ($user instanceof User) {
            $user->forceFill([
                'last_active_at' => Carbon::now(),
            ])
            ->save();
        }
        return $next($request);
    }
}
