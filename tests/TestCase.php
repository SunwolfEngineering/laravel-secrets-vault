<?php

namespace SunwolfEngineering\LaravelSecretsVault\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use SunwolfEngineering\LaravelSecretsVault\LaravelSecretsVaultServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelSecretsVaultServiceProvider::class,
        ];
    }

    // You can add any package-specific setup here
}
