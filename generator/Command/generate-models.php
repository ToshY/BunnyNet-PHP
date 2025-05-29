<?php

declare(strict_types=1);

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Generator\Generator\ModelGenerator;
use ToshY\BunnyNet\Generator\Utils\ClassUtils;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Generator\Utils\LoggerUtils;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UploadVideo;

require_once __DIR__ . '/../../vendor/autoload.php';

$options = getopt('', ['log']);
$showDiscrepancyLog = isset($options['log']);

$apiSpecManifest = getenv('API_SPEC_MANIFEST');
$modelOutputDirectory = __DIR__ . '/../../src/Model/API';
$baseMapNamespace = 'ToshY\\BunnyNet\\Generator\\Map';

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

    $replacements = match ($key) {
        'Stream' => [
            ClassUtils::getShortClassName(UploadVideo::class) => [
                'headers' => array_merge(
                    Header::ACCEPT_JSON,
                    Header::CONTENT_TYPE_OCTET_STREAM,
                ),
            ],
        ],
        default => [],
    };

    $data[$key] = [
        'apiSpecPath' => $file['fileUrl'],
        'mappingClass' => $baseMapNamespace . '\\' . $key,
        'outputDirectory' => $modelOutputDirectory . '/' . $key,
        'replacements' => $replacements,
    ];
}

$logger = new LoggerUtils();
$logger::$debug = $showDiscrepancyLog;

foreach ($data as $apiType => $config) {
    echo "[$apiType API] Generating models" . PHP_EOL;

    $modelGenerator = new ModelGenerator(
        $config['apiSpecPath'],
        $config['outputDirectory'],
        $config['mappingClass'],
        $config['replacements'],
        $logger,
    );

    $modelGenerator->generate();

    echo "[$apiType API] Models generated successfully" . PHP_EOL;

    // Autofix with php-cs-fixer for this API's output directory
    shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($config['outputDirectory']));
}
