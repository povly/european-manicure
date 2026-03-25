<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['includes.header'], function ($view) {
            $headerSetting = Setting::getBySlug('header');
            $view->with('headerSetting', $headerSetting?->content);
        });
    }
}
