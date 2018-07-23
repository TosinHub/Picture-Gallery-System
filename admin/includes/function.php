<?php

/* function __autoload($class){
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

    if(file_exists($the_path)){
        require_once($the_path);

    }else{
        die("This file {$class}.php was not found...");
    }
} */

function ClassAutoLoader($class){
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

    if(is_file($the_path) && !class_exists($class)){
        include($the_path);

    }else{
        die("This file {$class}.php was not found...");
    }
}

spl_autoload_register('ClassAutoLoader');

function redirect($path){
       header("Location:".$path);
}