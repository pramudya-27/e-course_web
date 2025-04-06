<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.admin', function ($view) {
            $unreadMessages = Contact::where('is_read', false)->orderBy('created_at', 'desc')->take(5)->get();
            $unreadMessagesCount = Contact::where('is_read', false)->count();
            $view->with('unreadMessages', $unreadMessages)->with('unreadMessagesCount', $unreadMessagesCount);
        });
    }
}
