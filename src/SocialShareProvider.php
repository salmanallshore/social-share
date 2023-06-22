<?php

namespace Datumsquare\SocialShare;

use Illuminate\Support\ServiceProvider;
use Datumsquare\SocialShare\Service\SocialShareService;
use Datumsquare\SocialShare\Service\Connectors\Facebook\Provider\FacebookServiceProvider;

class SocialShareProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('socialshare', function() {
            return new SocialShareService();
        });

        $this->app->register(FacebookServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/socialshare.php', 'socialshare',
        );

        $this->publishes([
            __DIR__.'/config/socialshare.php' => config_path('socialshare.php'),
        ]);
    }
}
