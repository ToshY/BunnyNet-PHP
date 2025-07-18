<?php

declare(strict_types=1);

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Generator\Generator\ModelGenerator;
use ToshY\BunnyNet\Generator\Utils\ClassUtils;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Generator\Utils\LoggerUtils;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ImportDnsRecords;
use ToshY\BunnyNet\Model\Api\Base\Integration\GetGitHubIntegration;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UploadVideo;

require_once __DIR__ . '/../../vendor/autoload.php';

$options = getopt('', ['log']);
$showDiscrepancyLog = isset($options['log']);

$apiSpecManifest = getenv('API_SPEC_MANIFEST');
$modelOutputDirectory = __DIR__ . '/../../src/Model/Api';
$validationMappingOutputDirectory = __DIR__ . '/../../src/Enum/Validation/Map';
$baseMapNamespace = 'ToshY\\BunnyNet\\Generator\\Map';

$validationMapNamespace = FileUtils::filePathToFqcn($validationMappingOutputDirectory);
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

    $replacements = match ($key) {
        \ToshY\BunnyNet\Enum\Generator::BASE->value, => [
            ClassUtils::getShortClassName(ImportDnsRecords::class) => [
                'constructor' => [
                    'body' => [
                        'type' => 'mixed',
                        'default' => null,
                    ],
                ],
            ],
        ],
        \ToshY\BunnyNet\Enum\Generator::EDGE_STORAGE->value, => [
            ClassUtils::getShortClassName(DownloadZip::class) => [
                'constructor' => [
                    'body' => [
                        'type' => 'mixed',
                        'default' => null,
                    ],
                ],
            ],
            ClassUtils::getShortClassName(UploadFile::class) => [
                'constructor' => [
                    'body' => [
                        'type' => 'mixed',
                        'default' => null,
                    ],
                ],
            ],
        ],
        \ToshY\BunnyNet\Enum\Generator::STREAM->value => [
            ClassUtils::getShortClassName(UploadVideo::class) => [
                'constructor' => [
                    'body' => [
                        'type' => 'mixed',
                        'default' => null,
                    ],
                ],
                'headers' => array_merge(
                    Header::ACCEPT_JSON,
                    Header::CONTENT_TYPE_OCTET_STREAM,
                ),
            ],
        ],
        default => [],
    };

    $validationReplacements  = match ($key) {
        \ToshY\BunnyNet\Enum\Generator::BASE->value, => [
            GetGitHubIntegration::class => ModelValidationStrategy::NONE,
        ],
        \ToshY\BunnyNet\Enum\Generator::EDGE_STORAGE->value, => [
            DownloadZip::class => ModelValidationStrategy::STRICT_BODY,
        ],
        default => [],
    };

    $data[$key] = [
        'apiSpecPath' => $file['fileUrl'],
        'mappingClass' => $baseMapNamespace . '\\' . $key,
        'validationMappingClass' => $key,
        'validationMappingNamespace' => $validationMapNamespace,
        'validationMappingOutputDirectory' => $validationMappingOutputDirectory,
        'outputDirectory' => $modelOutputDirectory . '/' . $key,
        'replacements' => $replacements,
        'validationReplacements' => $validationReplacements,
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
        $config['validationMappingClass'],
        $config['validationMappingNamespace'],
        $config['validationMappingOutputDirectory'],
        $config['replacements'],
        $config['validationReplacements'],
        $logger,
    );

    $modelGenerator->generate();

    echo "[$apiType API] Models generated successfully" . PHP_EOL;

    // Autofix with php-cs-fixer for this API's output directory
    shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($config['outputDirectory']));
}

// Autofix with php-cs-fixer for validation mapping output directory
shell_exec('php vendor/bin/php-cs-fixer --quiet fix ' . realpath($validationMappingOutputDirectory));
