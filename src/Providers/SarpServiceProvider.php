<?php

namespace Rakhiazfa\LaravelSarp\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Rakhiazfa\LaravelSarp\Commands\MakeRepository;
use Rakhiazfa\LaravelSarp\Commands\MakeRepositoryInterface;

class SarpServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('laravel-sarp.auto_bind')) {
            $this->bindInterfaces();
        }

        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-sarp.php', 'laravel-sarp');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepositoryInterface::class,
                MakeRepository::class,
            ]);

            $this->publishes([
                __DIR__ . '/../../config/laravel-sarp.php' => config_path('laravel-sarp.php'),
            ], 'config');
        }
    }

    /**
     * Binds the repository with its interface.
     * 
     * @return void
     */
    protected function bindInterfaces()
    {
        $path = app_path('Repositories');
        $files = (file_exists($path)) ? File::files($path) : [];

        foreach ($files as $file) {

            $interface = 'App\Repositories\\' . $file->getFilenameWithoutExtension();
            $repository = 'App\Repositories\Models\\' . $file->getFilenameWithoutExtension() . 'Model';

            $this->app->bind($interface, $repository);
        }
    }
}
