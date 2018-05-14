<?php

function autoloader($class)
{
    $path = explode('\\', $class);
    $path = implode(DIRECTORY_SEPARATOR, $path);
    $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $path . '.php';
    if (file_exists($path)) {
        include_once $path;

        return true;
    }

    return false;
}

spl_autoload_register('autoloader');