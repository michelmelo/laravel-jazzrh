<?php

namespace MichelMelo\JazzRh\Providers;

use Illuminate\Support\ServiceProvider;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Repositories\ApplicantRepository;
use MichelMelo\JazzRh\Repositories\JobRepository;
use MichelMelo\JazzRh\Repositories\UserRepository;
use MichelMelo\JazzRh\Services\ApplicantService;
use MichelMelo\JazzRh\Services\JobService;
use MichelMelo\JazzRh\Services\UserService;

class JazzRhServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/jazzrh.php',
            'jazzrh'
        );

        // Register Repositories
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User);
        });

        $this->app->singleton(JobRepository::class, function ($app) {
            return new JobRepository(new Job);
        });

        $this->app->singleton(ApplicantRepository::class, function ($app) {
            return new ApplicantRepository(new Applicant);
        });

        // Register Services
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->singleton(JobService::class, function ($app) {
            return new JobService($app->make(JobRepository::class));
        });

        $this->app->singleton(ApplicantService::class, function ($app) {
            return new ApplicantService($app->make(ApplicantRepository::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../Config/jazzrh.php' => config_path('jazzrh.php'),
        ], 'jazzrh-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../Database/Migrations' => database_path('migrations'),
        ], 'jazzrh-migrations');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');

        // Load translations (if any)
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'jazzrh');
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            UserRepository::class,
            JobRepository::class,
            ApplicantRepository::class,
            UserService::class,
            JobService::class,
            ApplicantService::class,
        ];
    }
}
