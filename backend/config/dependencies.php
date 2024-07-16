<?php

declare(strict_types=1);

$pathSrc = realpath($_SERVER["DOCUMENT_ROOT"]);

$files = array_merge(
    glob($pathSrc . '/config/common/*.php') ?: [],
    glob($pathSrc . '/config/settings/*.php') ?: [],
);

$configs = array_map(
    static function ($file) {
        return require $file;
    },
    $files
);

return array_replace_recursive(...$configs);
