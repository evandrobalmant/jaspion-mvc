<?php
require 'lib/Router.php';;
$router = Router::getInstance();

$router->register('/', 'IndexController', 'indexAction');
$router->register('/test', 'IndexController', 'testAction', array('foo' => 'bar'));