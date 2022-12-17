<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpVersion(phpVersion: PhpVersion::PHP_81);
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
    $rectorConfig->parallel(seconds: 600, maxNumberOfProcess: 32);

    $rectorConfig->autoloadPaths(autoloadPaths: [
        __DIR__ . '/vendor/autoload.php',
    ]);

    $rectorConfig->paths(paths: [
        __DIR__ . '/src',
    ]);

    $rectorConfig->skip(criteria: [
        __DIR__ . '/vendor',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_74,
        LevelSetList::UP_TO_PHP_80,
        LevelSetList::UP_TO_PHP_81,
    ]);
};
