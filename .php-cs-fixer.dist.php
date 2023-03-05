<?php

$finder = (new PhpCsFixer\Finder())
    ->exclude(__DIR__ . '/vendor')
    ->in(__DIR__ . '/src')
    ->name('*.php');

return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'trailing_comma_in_multiline' => [
            'elements' => [
                'arguments',
                'arrays',
                'match',
                'parameters',
            ],
        ],
        'no_unused_imports' => true,
    ])
    ->setFinder($finder);
