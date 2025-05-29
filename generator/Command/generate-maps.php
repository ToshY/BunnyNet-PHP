<?php

declare(strict_types=1);

use ToshY\BunnyNet\Generator\Generator\MapGenerator;
use ToshY\BunnyNet\Generator\Utils\FileUtils;

require_once __DIR__ . '/../../vendor/autoload.php';

$apiSpecManifest = getenv('API_SPEC_MANIFEST');
$modelInputDirectory = __DIR__ . '/../../src/Model/API';
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
        str_contains($description, 'bunny.net API') => 'Base',
        str_contains($description, 'Edge Scripting API') => 'EdgeScripting',
        str_contains($description, 'Edge Storage API') => 'EdgeStorage',
        str_contains($description, 'Stream API') => 'Stream',
        str_contains($description, 'Shield API') => 'Shield',
        default => throw new RuntimeException(
            sprintf(
                'Unknown API type with description: `%s`',
                $description,
            ),
        ),
    };

    $ignoreEndpoints = match ($key) {
        'Base' => [
            /* Changed to EdgeScripting */
            '/compute/script',
            '/compute/script/{id}',
            '/compute/script/{id}/code',
            '/compute/script/{id}/releases',
            '/compute/script/{id}/publish',
            '/compute/script/{id}/publish/{uuid}',
            '/compute/script/{id}/variables/add',
            '/compute/script/{id}/variables/{variableId}',
        ],
        default => [],
    };

    $data[$key] = [
        'apiSpecPath' => $file['fileUrl'],
        'modelDirectory' => $modelInputDirectory . '/' . $key,
        'mappingClassName' => $key,
        'outputDirectory' => $outputDirectory,
        'ignoreEndpoints' => $ignoreEndpoints,
    ];
}

foreach ($data as $namespace => $config) {
    $generator = new MapGenerator(
        $config['apiSpecPath'],
        $config['outputDirectory'],
        $config['mappingClassName'],
        $config['modelDirectory'],
        $config['ignoreEndpoints'],
    );
    $generator->generate();

    echo "[$namespace] Mapping class generated successfully" . PHP_EOL;
}

// Autofix with php-cs-fixer
shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($outputDirectory));
