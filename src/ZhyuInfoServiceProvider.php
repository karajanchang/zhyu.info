<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2019-03-02
 * Time: 05:36
 */

namespace ZhyuInfo;

use Illuminate\Support\ServiceProvider;
use ZhyuInfo\Facades\InfobipFacade;
use ZhyuInfo\Helpers\InfobipService;


class ZhyuInfoServiceProvider extends ServiceProvider
{
    protected $commands = [
    ];

    public function register(){
        $this->loadFunctions();


        $this->app->bind('InfobipSms', function()
        {
            return app()->make(InfobipService::class);
        });

        $this->registerAliases();
    }

    public function boot(){
        if ($this->isLumen()) {
            require_once 'Lumen.php';
        }

        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'twdd');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views'),
        ]);
    }

    protected function loadFunctions(){
        foreach (glob(__DIR__.'/functions/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            ZhyuInfoServiceProvider::class,
        ];
    }

    /**
     * Register aliases.
     *
     * @return null
     */
    protected function registerAliases()
    {
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            $loader->alias('InfobipSms',  InfobipFacade::class);
        }
    }

    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen');
    }
}
