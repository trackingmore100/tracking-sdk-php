<?php

class Autoloader
{
    /**
     * Autoloade Class in SDK.
     * PS: only load SDK class
     * @param string $class class name
     * @return void
     */
    public static function autoload($class)
    {
        $filename = dirname(__FILE__) . "/{$class}.php";
        if (file_exists($filename)) require_once($filename);
        else die("class '{$class}' can not found");
    }

}

spl_autoload_register('Autoloader::autoload');
?>