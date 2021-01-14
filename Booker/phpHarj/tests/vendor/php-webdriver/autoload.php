<?php

spl_autoload_register(function ($className) {
    $path = './vendor/php-webdriver/webdriver/lib/';

    $filePath = str_replace('Facebook\WebDriver\\', $path, $className);

    $filePath = str_replace('\\', '/', $filePath);

    $filePath .= '.php';

    require_once $filePath;
});
