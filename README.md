<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP

<div align="left">
    <img src="https://img.shields.io/packagist/v/toshy/bunnynet-php?label=Packagist" alt="Current bundle version" />
    <img src="https://img.shields.io/packagist/dt/toshy/bunnynet-php?label=Downloads" alt="Packagist Total Downloads" />
    <img src="https://img.shields.io/packagist/php-v/toshy/bunnynet-php?label=PHP" alt="PHP version requirement" />
    <img src="https://img.shields.io/badge/PSR-7%2F18-brightgreen" alt="PHP-FIG PSR-7" />
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpcs.yml?branch=master&label=PHPCS" alt="Code style">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpmd.yml?branch=master&label=PHPMD" alt="Mess detector">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpstan.yml?branch=master&label=PHPStan" alt="Static analysis">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpunit.yml?branch=master&label=PHPUnit" alt="Unit tests">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/security.yml?branch=master&label=Security" alt="Security">
</div>

<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming and image optimizers.

<small>
<b>Note</b>: This is a non-official library for the <a href="https://docs.bunny.net/docs">bunny.net API</a>.
</small>

## 🧰 Install

```bash
composer require toshy/bunnynet-php:^3.0
```

### Versions

| PHP             | Release  |
|-----------------|----------|
| ~~^7.4 / ^8.0~~ | ~~^2.0~~ |
| ^8.1            | ^3.0     |

> Note: The `2.x` is not longer actively maintained.


## 📜 Documentation

For more details and code examples, please check the [documentation website](http://ToshY.github.io/BunnyNet-PHP).

### Reference

This library was created with the hand of the
available [bunny.net API docs](https://docs.bunny.net/reference/bunnynet-api-overview). <br />

### Notes

* Naming conventions are kept close to the original API specification.
* Tested the majority of the endpoints myself to validate if they are working correctly. If you happen to
  come across a bug, just submit an issue, and I'll take a look at it.

## 🛠️ Contribute

Features and bugfixes should be based on the `master` branch.

### Prerequisites

* [Docker Compose](https://docs.docker.com/compose/install/)
* [Task (optional)](https://taskfile.dev/installation/)

### Up service

```shell
task composer:install 
```

### Run checks

Run `phpcs`, `phpstan`, `phpmd` and `phpunit`.

```shell
task contribute
```

> Note: 

## ❕ Licence

The BunnyNet PHP library is licensed under [MIT](LICENSE).
