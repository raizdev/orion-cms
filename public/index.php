<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Sunrise\Http\ServerRequest\ServerRequestFactory;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\RequestHandler\QueueableRequestHandler;

use function Sunrise\Http\Router\emit;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/etc/helper.php';

$container = require __DIR__ . '/../app/etc/container.php';

$router = $container->get('router');
$middlewares = $container->get('middlewares');

$handler = new QueueableRequestHandler($router);
$handler->add(...$middlewares);

$request = ServerRequestFactory::fromGlobals();
$response = $handler->handle($request);

emit($response);

exit(0);