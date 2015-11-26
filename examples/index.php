<?php
session_start();

function __autoload($className)
{
    $fileName = preg_replace('/^BolCom\\\\(\w+)/', 'src/bolcom/$1.php', $className);
    if (file_exists($fileName)) {
        return require_once $fileName;
    }
}

//please fill in your API-key in Example.php before running index.php
require_once 'Example.php';

Example::run();