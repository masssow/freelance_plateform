<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->name('*.php');

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true, // Utiliser les règles PSR-12
        'array_syntax' => ['syntax' => 'short'], // Rendre la syntaxe des tableaux courte
    ])
    ->setFinder($finder);
