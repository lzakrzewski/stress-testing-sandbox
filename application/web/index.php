<?php

use Wall\Http\Server\WebServer;

require __DIR__.'/../vendor/autoload.php';

$app = new WebServer();
$app->run();
