<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Secrets Vault Package Settings
    |--------------------------------------------------------------------------
    |
    | General settings for the Secrets Vault service
    |
    */

    'enabled' => env('LARAVEL_SECRETS_VAULT_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | AWS Configuration
    |--------------------------------------------------------------------------
    |
    | The AWS Configuration settings for using AWS Secrets Manager as a vault provider.
    |
    */

    'region' => env('AWS_DEFAULT_REGION'),
    'access-key-id' => env('AWS_ACCESS_KEY_ID'),
    'secret-access-key' => env('AWS_SECRET_ACCESS_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Tag used to return list of Secrets
    |--------------------------------------------------------------------------
    |
    | All the secrets with the `stage:local` tag will be loaded into environment variables.
    |
    */

    'tag-key' => env('LARAVEL_SECRETS_VAULT_TAG_NAME', 'stage'),
    'tag-value' => env('LARAVEL_SECRETS_VAULT_TAG_VALUE', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Config mappings
    |--------------------------------------------------------------------------
    |
    | Provide a mapping of secret key name to Laravel config name. Multiple
    | config names can be provided to a given secret name if necessary.
    |
    */

    'mappings' => [
        'LARAVEL_SECRETS_VAULT_SINGLE_EXAMPLE' => [
            'secrets-vault.single-example',
        ],
        'LARAVEL_SECRETS_VAULT_MULTI_EXAMPLE' => [
            'secrets-vault.multi-example',
            'secrets-vault.multi-example-other',
        ],
    ],
];