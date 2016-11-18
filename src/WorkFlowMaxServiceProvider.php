<?php
/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\WorkFlowMax;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the workflowmax service provider class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxServiceProvider extends ServiceProvider
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
        $source = realpath(__DIR__.'/../config/workflowmax.php');
//dd('source', $source);
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('workflowmax.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('workflowmax');
        }

        $this->mergeConfigFrom($source, 'workflowmax');
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
        $this->app->singleton('workflowmax.factory', function () {
            return new WorkFlowMaxFactory();
        });

        $this->app->alias('workflowmax.factory', WorkFlowMaxFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('workflowmax', function (Container $app) {
            $config = $app['config'];
            $factory = $app['workflowmax.factory'];

            return new WorkFlowMaxManager($config, $factory);
        });
        $this->app->alias('workflowmax', WorkFlowMaxManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('workflowmax.connection', function (Container $app) {
            $manager = $app['workflowmax'];
            return $manager->connection();
        });
        $this->app->alias('workflowmax.connection', Client::class);
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'workflowmax.factory',
            'workflowmax',
            'workflowmax.connection',
        ];
    }
}