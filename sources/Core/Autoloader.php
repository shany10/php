<?php

spl_autoload_register("myAutoloader");
function myAutoloader(string $class):void
{
    $class = str_ireplace('App', '.',$class);
    $class =str_ireplace('\\', '/',$class).".php";
    if(file_exists($class)){
        include $class;
    }
}