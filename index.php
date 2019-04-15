<?php
  
use App\system\Router;

require __DIR__ . '/vendor/autoload.php';

$rout = new Router($_GET['route']);
$rout->run();
