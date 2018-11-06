<?php
require __DIR__.'/../lib/MyFram/SplClassLoader.php';

$MyFramLoader = new SplClassLoader('MyFram', __DIR__.'/../lib');
$MyFramLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();


