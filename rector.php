<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
    $rectorConfig->parallel();

    $rectorConfig->paths(paths: [
        __DIR__ . '/src',
    ]);

    $rectorConfig->skip(skip: [
        NullToStrictStringFuncCallArgRector::class => [
            __DIR__ . '/src/TokenAuthentication.php',
        ],
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        LevelSetList::UP_TO_PHP_82,
        LevelSetList::UP_TO_PHP_83,
    ]);
};
