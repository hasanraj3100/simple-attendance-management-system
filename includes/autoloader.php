<?php

function autoloader($className) {
    $fileName= str_replace('\\', '/', $className);
    include __DIR__ . '/../Classes/' . $fileName . '.php';

}

spl_autoload_register('autoloader');