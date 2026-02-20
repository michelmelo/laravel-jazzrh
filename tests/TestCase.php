<?php

namespace MichelMelo\JazzRh\Tests;

use MichelMelo\JazzRh\Providers\JazzRhServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Run all package migrations explicitamente
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../src/Database/Migrations');
        $this->artisan('migrate', ['--database' => 'testing'])->run();
    }

    protected function getPackageProviders($app): array
    {
        return [
            JazzRhServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'JazzRh' => 'MichelMelo\\JazzRh\\Facades\\JazzRh',
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
