<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
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
    public function boot(): void
    {
        /** use Cache for not duplicated queries general setting */
        Paginator::useBootstrap();

        // Cache GeneralSetting for 1 hour (3600 seconds)
        $generalSetting = Cache::remember('general_setting', 3600, function() {
            return GeneralSetting::first();
        });

        $logoSetting = LogoSetting::first();
        $mailSetting = EmailConfiguration::first();

        /** Set timezone */
        if ($generalSetting && $generalSetting->time_zone) {
            Config::set('app.timezone', $generalSetting->time_zone);
        }

        /** Set mail config */
        if ($mailSetting) {
            Config::set('mail.mailers.smtp.host', $mailSetting->host);
            Config::set('mail.mailers.smtp.port', $mailSetting->port);
            Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
            Config::set('mail.mailers.smtp.username', $mailSetting->username);
            Config::set('mail.mailers.smtp.password', $mailSetting->password);
        }

        /** Share variables with all views */
        View::composer('*', function($view) use ($generalSetting, $logoSetting) {
            $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting]);
        });
    }
}
