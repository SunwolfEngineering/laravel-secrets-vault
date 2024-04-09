<?php

namespace SunwolfEngineering\LaravelSecretsVault;

use Illuminate\Support\ServiceProvider;

class LaravelSecretsVaultServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => base_path('config/secrets-vault.php'),
            ], 'config');
        }

        // Set secrets into config if enabled
        if (config('secrets-vault.enabled')) {
            $secretsVault = new LaravelSecretsVault();
            $secretsVault->setConfig();
        }
    }
}
