<?php

spl_autoload_register(function ($class) {
    include_once '../App/Models/' . $class . '.class.php';
    include_once '../Module/Connection.class.php';
});