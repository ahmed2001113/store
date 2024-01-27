<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */// فانكشن علشان لو اتبعت نوتيفيكيشن نجيب الاي دي ولو فيه يوزر ده معناه انه عامل تسجيل دخول هنجيب اليوزر ده وهنخلي الرساله مقروئه
    public function handle(Request $request, Closure $next)
    {
        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $user = $request->user();
            if ($user) {
                $notification = $user->unreadNotifications()->find($notification_id);
                if ($notification) {
                    $notification->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
