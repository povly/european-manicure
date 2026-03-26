<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('includes.footer', function ($view) {
            $footerSetting = Setting::getBySlug('footer');
            $footerData = [];
            if ($footerSetting?->content) {
                foreach ($footerSetting->content as $block) {
                    if ($block->getName() === 'footer') {
                        $footerData = $block->getValues();
                        break;
                    }
                }
            }
            $view->with('footerData', $footerData);
        });
    }
}
