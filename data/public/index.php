<?php
require __DIR__.'/vendor/autoload.php';

use Src\Main;

$instance = new Main();

print_r($instance->test());