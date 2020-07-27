<?php
class Autoloader{

    /**
    * Register autoloader
    */
    static function loadClass(){
        spl_autoload_register(function($class) {
            require '_classes/' . $class . '.php';
        });
    }
}