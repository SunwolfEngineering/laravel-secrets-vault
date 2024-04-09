<?php

namespace SunwolfEngineering\LaravelSecretsVault;

use Aws\SecretsManager\SecretsManagerClient;

use Illuminate\Support\Facades\Log;

class LaravelSecretsVault
{
    protected $client;
    protected $filterTagKey;
    protected $filterTagValue;
    protected $configMappings;

    public function __construct()
    {
        $this->filterTagKey = config('secrets-vault.tag-key');
        $this->filterTagValue = config('secrets-vault.tag-value');

        $this->configMappings = config('secrets-vault.mappings');
    }

    public function setConfig()
    {
        $secretValues = $this->fetchSecrets();

        foreach ($secretValues as $key => $value) {
            // Check if there's a mapping for this environment variable
            if (isset($this->configMappings[$key])) {
                // Get the corresponding Laravel configuration keys
                $configKeys = $this->configMappings[$key];

                // Ensure $configKeys is always an array to simplify logic
                $configKeys = is_array($configKeys) ? $configKeys : [$configKeys];

                foreach ($configKeys as $configKey) {
                    // Set the configuration value for each mapped key
                    config()->set($configKey, $value);
                }
            }
        }
    }

    protected function fetchSecrets(): array
    {
        $secretKVPairs = [];

        try {
            $this->client = new SecretsManagerClient([
                'version' => '2017-10-17',
                'region' => config('secrets-vault.region'),
                'credentials' => [
                    'key'    => config('secrets-vault.access-key-id'),
                    'secret' => config('secrets-vault.secret-access-key'),
                ],
            ]);

            $secrets = $this->client->listSecrets([
                'Filters' => [
                    [
                        'Key' => 'tag-key',
                        'Values' => [$this->filterTagKey],
                    ],
                    [
                        'Key' => 'tag-value',
                        'Values' => [$this->filterTagValue],
                    ],
                ],
                'MaxResults' => 100,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $secretKVPairs;
        }

        foreach ($secrets['SecretList'] as $secret) {
            if (isset($secret['ARN'])) {
                $result = $this->client->getSecretValue([
                    'SecretId' => $secret['ARN'],
                ]);

                $secretValues = json_decode($result['SecretString'], true);

                if (is_array($secretValues) && count($secretValues) > 0) {
                    if (isset($secretValues['name']) && isset($secretValues['value'])) {
                        // Direct mapping of a single name/value pair into the result array
                        $secretKVPairs[$secretValues['name']] = $secretValues['value'];
                    } else {
                        // Accumulate multiple key/value pairs from the secret into the result array
                        foreach ($secretValues as $key => $value) {
                            $secretKVPairs[$key] = $value;
                        }
                    }
                }
            }
        }

        return $secretKVPairs;
    }
}
