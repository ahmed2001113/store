<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // فانكشن علشان لو الي هيسجل ادمن يغير كل الاعدادات الي في الكونفيج فورتيفاي لاعدادات الادمن
        $request = request();
        if ($request->is('admin/*')) {
            Config::set('fortify.guard', 'admin');
            Config::set('fortify.passwords', 'admins');
            Config::set('fortify.prefix', 'admin');
            //Config::set('fortify.home', 'admin/dashboard');
        }
// فانكشن علشان لو الي سجل ادمن يروح علي صفحه الادمن داشبورد
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request) {
                if ($request->user('admin')) {
                    // انتينديد علشان يرجعه علي نفس الصفحه الي حاول يدخل عليها قبل ما يعمل لوجين و لو مفيش هيروح علي صفحه الادمن داشبورد
                    return redirect()->intended('admin/dashboard');
                }

                return redirect()->intended('/');
            }
        });
// فانكشن لوج اوت
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request) {
                return redirect('/');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

// نفس الكود الي تحت بس لو ادمن يروح علي صفحه معينه و لو يوزر يروح علي صفحه اخري
        if (Config::get('fortify.guard') == 'admin') {
            // فانكشن علشان لو اليوزر اختار يسجل باالاسم او رقم التليفون بدل الايميل
            Fortify::authenticateUsing([new AuthenticateUser, 'authenticate']);
            Fortify::viewPrefix('auth.');
        } else {
            Fortify::viewPrefix('front.auth.');
        }
// فانكشن اللوجين والريجيستر انت الي بتضبفهم
        // Fortify::loginView(function() {
        //     if (Config::get('fortify.guard') == 'web') {
        //         return view ('front.auth.login');
        //     }
        //     return view('auth.login');
        // });
        // Fortify::registerView(function() {
        //     return view('auth.register');
        // });
    }
}
