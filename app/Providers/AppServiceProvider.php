<?php

namespace App\Providers;

use App\Notification;
use App\Company;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $loggedUser = null;
            if (Auth::check()) {
                $loggedUser = Auth::user();
                $notifications = Notification::whereUserId($loggedUser->id)->orderBy('updated_at', 'desc')->limit(5)->get();
                $new = Notification::whereUserId($loggedUser->id)->whereQuickView('0')->get();
            } else {
                $notifications = null;
                $new = null;
            }

            // $current_lang = current_language();

            $view->with(['lUser' => $loggedUser, 'notifications' => $notifications, 'new_notfs' => $new]);
        });
    }
}
