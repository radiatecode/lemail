<?php

namespace App\Providers;

use App\Receiver;
use App\Repository\Message\MessageEloquent;
use App\Repository\Message\MessageInterface;
use App\Repository\Profiles\ProfileEloquent;
use App\Repository\Profiles\ProfileInterface;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $users = User::userListExceptAuthOne(Auth::user()->id);
                $receiver = Receiver::whereNull('read_at')
                    ->whereNull('deleted_at')
                    ->where('receiver_id',Auth::user()->id)
                    ->get();
                $view->with('users', $users)
                ->with('unread',$receiver);
            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProfileInterface::class,ProfileEloquent::class);
        $this->app->singleton(MessageInterface::class,MessageEloquent::class);
    }
}
