<?php

namespace Rakhiazfa\LaravelSarp\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Rakhiazfa\LaravelSarp\Commands\MakeRepository;
use Rakhiazfa\LaravelSarp\Commands\MakeRepositoryInterface;
use Rakhiazfa\LaravelSarp\Commands\MakeService;
use Rakhiazfa\LaravelSarp\Commands\MakeServiceInterface;

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
            $this->bindAllRepositories();
            $this->bindAllServices();
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
                MakeServiceInterface::class,
                MakeService::class,
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
    protected function bindAllRepositories()
    {
        /**
         * Auto bind the repositories.
         * 
         */

        $path = app_path('Repositories');
        $directories = (file_exists($path)) ? File::directories($path) : [];

        foreach ($directories as $directory) {

            $files = (file_exists($directory)) ? File::files($directory) : [];

            $classes = [];

            foreach ($files as $file) {

                $directory = basename($directory);

                $classes[] = 'App\Repositories\\' . $directory . '\\' . $file->getFilenameWithoutExtension();;
            }

            $this->app->bind($classes[0], $classes[1]);
        }
    }

    /**
     * Binds the service with its interface.
     * 
     * @return void
     */
    public function bindAllServices()
    {
        /**
         * Auto the bind services.
         * 
         */

        $path = app_path('Services');
        $directories = (file_exists($path)) ? File::directories($path) : [];

        foreach ($directories as $directory) {

            $files = (file_exists($directory)) ? File::files($directory) : [];

            $classes = [];

            foreach ($files as $file) {

                $directory = basename($directory);

                $classes[] = 'App\Services\\' . $directory . '\\' . $file->getFilenameWithoutExtension();;
            }

            $this->app->bind($classes[0], $classes[1]);
        }
    }
}
