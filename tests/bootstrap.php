<?php
$dir = realpath(__DIR__ . '/../');
spl_autoload_register(
    function($class)
    {
        $dir = realpath(__DIR__ . '/../src');
        $target = explode('\\', $class);
        $path = $dir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $target) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
);

