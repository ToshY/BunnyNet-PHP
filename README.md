<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP

<div align="left">
    <img src="https://img.shields.io/packagist/v/toshy/bunnynet-php?label=Packagist" alt="Current bundle version" />
    <img src="https://img.shields.io/packagist/dt/toshy/bunnynet-php?label=Downloads" alt="Packagist Total Downloads" />
    <img src="https://img.shields.io/packagist/php-v/toshy/bunnynet-php?label=PHP" alt="PHP version requirement" />
    <img src="https://img.shields.io/badge/PSR-18-brightgreen" alt="PHP-FIG PSR-18" />
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpcs.yml?branch=master&label=PHPCS" alt="Code style">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpmd.yml?branch=master&label=PHPMD" alt="Mess detector">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpstan.yml?branch=master&label=PHPStan" alt="Static analysis">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpunit.yml?branch=master&label=PHPUnit" alt="Unit tests">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/security.yml?branch=master&label=Security" alt="Security">
</div>

<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming, image optimizers and much more!

> [!IMPORTANT]  
> This is a non-official PHP library for the [Bunny.net API](https://docs.bunny.net/docs).

## 🧰 Install

```bash
composer require toshy/bunnynet-php:^8.0
```

## 📜 Documentation

The documentation is available at [https://toshy.github.io/BunnyNet-PHP](https://toshy.github.io/BunnyNet-PHP).

## 🛠️ Contribute

Features and bugfixes should be based on the `master` branch.

### Prerequisites

* [Docker Compose](https://docs.docker.com/compose/install/)
* [Task (optional)](https://taskfile.dev/installation/)

### Install dependencies

```shell
task composer:install 
```

### Enable pre-commit hook

```shell
task git:hooks
```

> [!NOTE]  
> Checks for `phpcs`, `phpstan`, `phpmd` and `phpunit` are executed when committing. 
> You can also run these checks with `task contribute`.

### 🤖 Automated PRs

This repository has a workflow run (see [generator](.github/workflows/generator.yml)) that creates or updates existing [models](src/Model/API) based on the latest OpenAPI specifications and subsequently
creates a (draft) PR for these changes. You can identify these automated PRs with the labels `OpenAPI` and `automated`.

The automated PRs contain two tasks:
- [x] Add/Update API models
- [ ] Add/Update documentation examples (when needed)

The first task is already done by the generator, but if you want to fix the other task, please use the following way of working.

1. Fork the repository and make sure to copy all branches (not just `master`).
2. Create a branch based on the automated PR branch.
   - The automated branches will be named `generator/update-api-models`.
3. Make the desired changes in your own branch.
4. Create a PR with your branch, denote your changes and reference the existing automated (draft) PR.

## ❕ Licence

This repository comes with a [MIT license](./LICENSE).
