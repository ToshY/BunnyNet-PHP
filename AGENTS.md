# AGENTS.md

## Project Overview

PHP client library for the [Bunny.net](https://bunny.net) API. Each API endpoint is a **model class** under `src/Model/Api/{ApiGroup}/{Category}/` — most are **auto-generated** from OpenAPI specs via `generator/`. The library is PSR-18 based; users supply their own HTTP client.

## Architecture

- **`BunnyHttpClient`** — single entry point; takes a `ModelInterface` model, extracts path/query/body/headers via PHP 8.1 attributes, builds a PSR-7 request, sends it.
- **Model classes** (`src/Model/Api/`) — one class per API endpoint. Implements `ModelInterface` and optionally `BodyModelInterface`/`QueryModelInterface`. Constructor properties use `#[PathProperty]`, `#[QueryProperty]`, `#[BodyProperty]`, `#[HeaderProperty]` attributes to tag parameter roles. Path placeholders use `sprintf` format (e.g. `pullzone/%d`).
- **Validation** — `BunnyValidator` delegates to strategy enums in `src/Enum/Validation/ModelValidationStrategy.php`. Validation maps in `src/Enum/Validation/Map/` are auto-generated.
- **Generator** (`generator/`) — reads external OpenAPI manifest (`API_SPEC_MANIFEST` env var), produces model classes and validation maps. Two-step: `generate-maps.php` then `generate-models.php`. Run via `task specs`.
- **Other services**: `BunnyTokenAuthentication` (URL token signing), `BunnyImageProcessor` (image optimization URL builder).

## Model Class Pattern

Every model follows this exact structure (see `src/Model/Api/Core/PullZone/GetPullZone.php`):

```php
class GetPullZone implements ModelInterface, QueryModelInterface
{
    public function __construct(
        #[PathProperty] public readonly int $id,      // path params in order
        #[QueryProperty] public readonly array $query = [],
    ) {}
    public function getMethod(): Method { return Method::GET; }
    public function getPath(): string { return 'pullzone/%d'; }  // sprintf placeholders
    public function getHeaders(): array { return [Header::ACCEPT_JSON]; }
    public function getQuery(): array { return [new AbstractParameter(...)]; }
}
```

**Do not hand-edit generated models** in `src/Model/Api/` or `src/Enum/Validation/Map/` — they will be overwritten by the generator.

## Development Environment

All tools run inside Docker via [Task](https://taskfile.dev) (see `Taskfile.yml`):

```shell
task composer:install   # Install dependencies
task contribute         # Run all checks (phpcs, phpstan, phpmd, phpunit)
task phpcs              # Code style (php-cs-fixer, dry-run)
task phpcs:fix          # Auto-fix code style
task phpstan            # Static analysis (level 6)
task phpmd              # Mess detector
task phpunit            # Unit tests (PHPUnit 10)
task rector             # Rector dry-run
task rector:fix         # Apply Rector fixes
task specs              # Regenerate models from OpenAPI specs (maps → models → maps)
```

Git pre-commit hooks run `phpcs`, `phpstan`, `phpmd`, and `phpunit` — enable via `task git:hooks`.

## Key Conventions

- **`declare(strict_types=1)`** in every PHP file.
- **Namespace**: `ToshY\BunnyNet\` maps to `src/`, `ToshY\BunnyNet\Tests\` to `tests/`, `ToshY\BunnyNet\Generator\` to `generator/`.
- **Named arguments** used consistently (e.g. `name:`, `type:`, `required:`).
- **Enums** for HTTP methods (`Method`), types (`Type`), MIME types (`MimeType`), headers (`Header`), endpoints (`Endpoint`), API groups (`Generator`).
- **PHPStan level 6** with `treatPhpDocTypesAsCertain: false`.
- **PHPMD** excludes `StaticAccess` rule from cleancode.
- **Rector** targets PHP 8.1–8.3 level sets, runs only on `src/`.
- Tests are in `tests/` mirroring `src/` structure. `ParameterValidatorTest` is the main test file.

## Documentation

Docs live in `docs/` and are built with [MkDocs Material](https://squidfunk.github.io/mkdocs-material/). Published at [toshy.github.io/BunnyNet-PHP](https://toshy.github.io/BunnyNet-PHP).

```shell
task mkdocs           # Build static site to site/
task mkdocs:live      # Dev server on port 8001 (override with p=PORT)
```

- **`mkdocs.yml`** — site config, nav tree, theme/extensions. The `nav:` section defines page order; update it when adding pages.
- Each API group has one doc page (e.g. `docs/core-api.md`, `docs/stream-api.md`) containing setup + usage examples for every endpoint in that group.
- Doc pages show usage via `$bunnyHttpClient->request(new ModelClass(...))` snippets — one per endpoint, matching the model classes in `src/Model/Api/`.
- Undocumented/deprecated endpoints use `??? warning "Undocumented endpoint"` admonitions.
- Non-API tools (`BunnyImageProcessor`, `BunnyTokenAuthentication`) each have a standalone page under `docs/`.
- Automated generator PRs (label `OpenAPI` + `automated`) include a manual task: _"Add/Update documentation examples (when needed)"_ — new or changed models may need corresponding doc snippets added.

## File Organization

| Path                                                                                 | Purpose                                            |
|--------------------------------------------------------------------------------------|----------------------------------------------------|
| `src/Model/Api/{Core,Stream,Shield,EdgeStorage,EdgeScripting,OriginErrors,Logging}/` | Auto-generated endpoint models                     |
| `src/Enum/Validation/Map/`                                                           | Auto-generated validation strategy maps            |
| `src/Attributes/`                                                                    | PHP 8.1 attributes for model property roles        |
| `src/Validation/Strategy/`                                                           | Body/Query validation strategies (Strict/Lax/None) |
| `generator/Map/`                                                                     | Intermediate mapping files from OpenAPI specs      |
| `generator/Generator/`                                                               | `ModelGenerator` and `MapGenerator` classes        |
| `generator/Enum/EndpointEdgeCases.php`                                               | Edge cases the generator handles specially         |

