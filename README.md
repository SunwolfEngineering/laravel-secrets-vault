# Laravel Secrets Vault

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sunwolfengineering/laravel-secrets-vault.svg?style=flat-square)](https://packagist.org/packages/sunwolfengineering/laravel-secrets-vault)
[![Total Downloads](https://img.shields.io/packagist/dt/sunwolfengineering/laravel-secrets-vault.svg?style=flat-square)](https://packagist.org/packages/sunwolfengineering/laravel-secrets-vault)
![GitHub Actions](https://github.com/sunwolfengineering/laravel-secrets-vault/actions/workflows/main.yml/badge.svg)

The Laravel Secrets Vault package provides a seamless integration between Laravel applications and secret management services, starting with support for AWS Secrets Manager. This package allows developers to securely manage application secrets, such as database passwords or API keys, outside of their version control systems, improving the security posture of their applications.

## Requirements
- Laravel 8.x or higher
- PHP 7.4 or higher

## Installation

You can install the package via composer:

```bash
composer require sunwolfengineering/laravel-secrets-vault
```

After installing, you should publish the package's configuration file to your application's config directory:

```bash
php artisan vendor:publish --provider="SunwolfEngineering\LaravelSecretsVault\LaravelSecretsVaultServiceProvider" --tag="config"
```

## Configuring your Secrets Vault
After publishing the config file, it will appear in your application's config directory as secrets-vault.php. You'll need to set the appropriate environment variables in your `.env` file to configure the AWS SDK and enable the package:

```bash
LARAVEL_SECRETS_VAULT_ENABLED=true
AWS_DEFAULT_REGION=your-aws-region
AWS_ACCESS_KEY_ID=your-aws-access-key-id
AWS_SECRET_ACCESS_KEY=your-aws-secret-access-key
LARAVEL_SECRETS_VAULT_TAG_NAME=stage
LARAVEL_SECRETS_VAULT_TAG_VALUE=local
```

Additionally, you can define mappings from secret keys in AWS Secrets Manager to your Laravel application's config keys within the mappings array in the secrets-vault.php config file.

## Usage

With the package installed and configured, it automatically fetches and injects the secrets into your Laravel application's configuration based on the mappings defined in the secrets-vault.php config file. This process occurs during the application's bootstrapping phase, ensuring that your secrets are available before your application services are loaded.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <tbody>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://purdy.dev/?ref=github"><img src="https://avatars.githubusercontent.com/u/6409227?v=4?s=100" width="100px;" alt="Joe Purdy"/><br /><sub><b>Joe Purdy</b></sub></a><br /><a href="#code-joepurdy" title="Code">💻</a> <a href="#maintenance-joepurdy" title="Maintenance">🚧</a></td>
    </tr>
  </tbody>
</table>

<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->

### Security

If you discover any security related issues, please email oss@sunwolf.studio instead of using the issue tracker.

## License

The GNU GPLv3. Please see [License File](LICENSE.md) for more information.

## About Sunwolf Studio

Sunwolf Studio, a Fractional SRE development studio based in Portland, offers expert services to startups navigating the dynamic landscape of product development. Specializing in Site Reliability Engineering, cybersecurity, cloud application development, and developer experience optimization, Sunwolf Studio bridges the gap between technological needs and business goals. With a deep commitment to elevating development practices and ensuring product reliability, they're ready to tackle challenges from the ground up and foster long-term growth. For more on their hands-on approach and to explore potential collaborations, visit [Sunwolf Studio](https://www.sunwolf.studio?ref=laravel-secrets-vault).
