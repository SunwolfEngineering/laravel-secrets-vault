<?php

namespace SunwolfEngineering\LaravelSecretsVault\Tests\Unit;

use SunwolfEngineering\LaravelSecretsVault\Tests\TestCase;
use SunwolfEngineering\LaravelSecretsVault\LaravelSecretsVault;
use Illuminate\Support\Facades\Config;

class LaravelSecretsVaultTest extends TestCase
{
    /** @test */
    public function it_initializes_config_values_properly()
    {
        // Mocking Laravel's config function responses
        Config::shouldReceive('get')
            ->with('secrets-vault.tag-key', null)
            ->once()
            ->andReturn('test-tag-key');

        Config::shouldReceive('get')
            ->with('secrets-vault.tag-value', null)
            ->once()
            ->andReturn('test-tag-value');

        Config::shouldReceive('get')
            ->with('secrets-vault.mappings', [])
            ->once()
            ->andReturn(['test-key' => 'test-mapping']);

        // Instantiating the LaravelSecretsVault class
        $vault = new LaravelSecretsVault();

        // Using reflection to access private properties for assertion
        $reflection = new \ReflectionClass($vault);
        $filterTagKeyProperty = $reflection->getProperty('filterTagKey');
        $filterTagValueProperty = $reflection->getProperty('filterTagValue');
        $configMappingsProperty = $reflection->getProperty('configMappings');

        $filterTagKeyProperty->setAccessible(true);
        $filterTagValueProperty->setAccessible(true);
        $configMappingsProperty->setAccessible(true);

        // Asserting that properties were set correctly
        $this->assertEquals('test-tag-key', $filterTagKeyProperty->getValue($vault));
        $this->assertEquals('test-tag-value', $filterTagValueProperty->getValue($vault));
        $this->assertEquals(['test-key' => 'test-mapping'], $configMappingsProperty->getValue($vault));
    }
}
