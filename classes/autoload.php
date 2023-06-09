<?php

spl_autoload_register('autoloader');

function autoloader($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    require_once($file);
}

?>
