<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Services\Di\Config\DiArgument;
use App\Services\Di\DiContainer;

try {
    $arg = new DiArgument();
    $di = new DiContainer($arg->getServices(), $arg->getParameters());
    $app = new App\Initialization($di);
    $app->init();
} catch (
    ReflectionException |
    App\Exceptions\ServiceNotFoundException |
    App\Exceptions\DiContainerException |
    App\Exceptions\ParameterNotFoundException $e
) {
    echo $e->getMessage();
}