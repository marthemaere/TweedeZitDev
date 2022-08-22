<?php
spl_autoload_register(function($classes){
    include_once(__DIR__."/../classes/".$classes.".php");
});