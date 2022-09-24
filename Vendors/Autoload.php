<?php

/**
 * Autoload permettant le chargement dynamique des classes dans le projet
 * 
 * @category Autoload
 * @package  Vendors
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

spl_autoload_register(function ($className) {
    $split = explode("\\", $className);

    if (count($split) >= 3) {
        $file = dirname(__DIR__) . '\\Src\\' . $split[count($split)-2] ."\\". $split[count($split)-1] . '.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

        if (file_exists($file)) {
            require_once $file;
        }
    } else {
        $file = dirname(__DIR__) . '\\Src\\' . $className . '.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    
        if (file_exists($file)) {
            require_once $file;
        }
    }
});
