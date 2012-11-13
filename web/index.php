<?php

// we could use composer autoload, but let use an example of class loader
//$loader = require __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../src/autoload.php';

$kernel = new \SfPot\Kernel();
$container = $kernel->boot();

$event = $container->get('event_alert');

print "<pre>";
var_dump($event);
print "</pre>";
