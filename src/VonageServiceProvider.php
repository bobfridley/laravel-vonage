<?php
/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Vonage;
use Vonage\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
/**
 * This is the vonage service provider class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/vonage.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('vonage.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('vonage');
        }
        $this->mergeConfigFrom($source, 'vonage');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }
    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('vonage.factory', function () {
            return new VonageFactory();
        });
        $this->app->alias('vonage.factory', VonageFactory::class);
    }
    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('vonage', function (Container $app) {
            $config = $app['config'];
            $factory = $app['vonage.factory'];
            return new VonageManager($config, $factory);
        });
        $this->app->alias('vonage', VonageManager::class);
    }
    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('vonage.connection', function (Container $app) {
            $manager = $app['vonage'];
            return $manager->connection();
        });
        $this->app->alias('vonage.connection', Client::class);
    }
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'vonage.factory',
            'vonage',
            'vonage.connection',
        ];
    }
}