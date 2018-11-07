<?php

require 'vendor/autoload.php';
try {
    $dotenv = new Dotenv\Dotenv(dirname(__DIR__));
    $dotenv->load();
} catch(Dotenv\Exception\InvalidPathException $e) {
    
}

