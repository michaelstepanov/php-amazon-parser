<?php

ini_set('max_execution_time', 300);
header('Content-Type: text/html; charset=utf-8');

require_once(dirname(__FILE__).'/libs/phpQuery/phpQuery.php');

// classes autoloading by namespace
spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = 'vendor\\';

    // prefix length
    $len = strlen($prefix);

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it once
    if (file_exists($file)) {
        require_once(dirname(__FILE__).'/'.$file);
    }
});