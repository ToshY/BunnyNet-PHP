<?php

declare(strict_types=1);

use ToshY\BunnyNet\Generator\Enum\EndpointEdgeCases;
use ToshY\BunnyNet\Generator\Generator\MapGenerator;
use ToshY\BunnyNet\Generator\Utils\FileUtils;

require_once __DIR__ . '/../../vendor/autoload.php';

$apiSpecManifest = getenv('API_SPEC_MANIFEST');
$modelInputDirectory = __DIR__ . '/../../src/Model/Api';
$outputDirectory = __DIR__ . '/../Map';

$file = FileUtils::getFile($apiSpecManifest);
if ($file === false) {
    throw new RuntimeException(
        sprintf(
            'Unable to load API spec file `%s`.',
            $apiSpecManifest,
        ),
    );
}
$manifests = FileUtils::jsonDecode($file);

$data = [];
foreach ($manifests as $file) {
    $description = $file['sourceDescription'];
    $key = match (true) {
        str_contains($description, 'bunny.net API') => \ToshY\BunnyNet\Enum\Generator::BASE->value,
        str_contains($description, 'Edge Scripting API') => \ToshY\BunnyNet\Enum\Generator::EDGE_SCRIPTING->value,
        str_contains($description, 'Edge Storage API') => \ToshY\BunnyNet\Enum\Generator::EDGE_STORAGE->value,
        str_contains($description, 'Stream API') => \ToshY\BunnyNet\Enum\Generator::STREAM->value,
        str_contains($description, 'Shield API') => \ToshY\BunnyNet\Enum\Generator::SHIELD->value,
        default => throw new RuntimeException(
            sprintf(
                'Unknown API type with description: `%s`',
                $description,
            ),
        ),
    };

    // Endpoints that are still available to use but no longer in the OpenAPI specs
    $keepUndocumentedEndpoints = match ($key) {
        \ToshY\BunnyNet\Enum\Generator::BASE->value => EndpointEdgeCases::BASE_API_UNDOCUMENTED_IN_OPEN_API_SPECS,
        default => [],
    };

    $data[$key] = [
        'apiSpecPath' => $file['fileUrl'],
        'modelDirectory' => $modelInputDirectory . '/' . $key,
        'mappingClassName' => $key,
        'outputDirectory' => $outputDirectory,
        'ignoreEndpoints' => [],
        'keepUndocumentedEndpoints' => $keepUndocumentedEndpoints,
    ];
}

foreach ($data as $namespace => $config) {
    $generator = new MapGenerator(
        $config['apiSpecPath'],
        $config['outputDirectory'],
        $config['mappingClassName'],
        $config['modelDirectory'],
        $config['ignoreEndpoints'],
        $config['keepUndocumentedEndpoints'],
    );
    $generator->generate();

    echo "[$namespace] Mapping class generated successfully" . PHP_EOL;
}

// Autofix with php-cs-fixer
shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($outputDirectory));
