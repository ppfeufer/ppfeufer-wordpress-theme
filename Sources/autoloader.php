<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer;

use Exception;
use RuntimeException;

/**
 * Autoloader for the theme classes and interfaces to be loaded dynamically.
 * This will allow us to include only the files we need when we need them.
 *
 * @param string $className The name of the class to load
 * @return void
 * @package WordPress\Ppfeufer\Theme\Ppfeufer
 */
spl_autoload_register(callback: static function (string $className): void {
    // Check if the class name starts with the base namespace
    if (!str_starts_with(haystack: $className, needle: __NAMESPACE__)) {
        return;
    }

    // Convert the class name to a relative file path
    $relativeClass = str_replace(
        search: [
            __NAMESPACE__ . '\\',
            '\\'
        ],
        replace: [
            '',
            DIRECTORY_SEPARATOR
        ],
        subject: $className
    );

    // Construct the full file path
    $file = __DIR__ . DIRECTORY_SEPARATOR . $relativeClass . '.php';

    // Include the file if it exists
    try {
        if (file_exists(filename: $file)) {
            include_once $file;
        } else {
            throw new RuntimeException(
                message: "Autoloader error: Class file for {$className} not found at {$file}"
            );
        }
    } catch (Exception $e) {
        error_log(message: $e->getMessage());
    }
});
